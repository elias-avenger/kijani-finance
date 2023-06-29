<?php 
  include 'includes/header.php';
  include "../controllers/models.php";
  include "../controllers/msg.php";           
?>
<!-- Dashboard Content -->
<div class="container mx-auto py-8 px-4">
  <h2 class="text-3xl font-bold mb-4">Users</h2>
  <!-- User Control Panel -->
  <div class="grid grid-cols-1 md:flex md:justify-center lg:justify-between gap-6">
    <!-- User Table -->
    <div class="bg-white shadow-md rounded-md p-4">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr>
              <th class="py-2">Name</th>
              <th class="py-2">Email</th>
              <th class="py-2">Phone</th>
              <th class="py-2">Role</th>
              <th class="py-2">Department</th>
              <th class="py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- User Row 1 -->
            <?php
              $users = getData('users');
              foreach($users as $user){
                $uid = $user['id'];
                if(mysqli_num_rows(getDepartment($uid)) > 0){
                  $department = mysqli_fetch_array(getDepartment($uid));
                  $dpt = $department['name'];
                }
                else{
                  $dpt = "Not Assigned";
                }                  
                ?>
                <!-- the row to display user information -->
                <tr id="main-row<?php echo $uid;?>" style="display: table-row;">
                  <td class="p-2"><?php echo $user['fname']." ".$user['lname'];?></td>
                  <td class="p-2"><?php echo $user['email'];?></td>
                  <td class="p-2"><?php echo $user['phone'];?></td>
                  <td class="p-2">
                    <?php 
                      $t = $user['type'];
                      if($t === 'A') 
                        echo "Admin"; 
                      elseif($t === 'B') 
                        echo "Budgeting"; 
                      elseif($t === 'C') 
                      echo "Budget Approving";
                    ?>
                  </td>
                  <td class="p-2"><?php echo $dpt;?></td>
                  <td class="flex gap-4 p-2">
                    <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                    <!-- delete button -->
                      <?php $model = 'user';?>
                      <button type="button" data-modal-target="delete<?php echo $model;?>Modal" data-modal-toggle="delete<?php echo $model;?>Modal">
                        <img src="../images/delete_black_24dp.svg" alt="delete">
                      </button>
                      <!-- delete modal -->
                      <?php
                        deleteModel($model, $user['id']);
                      ?>
                  </td>
                </tr>
                <!-- the row to display an edit form for user info -->
                <tr id="edit-row<?php echo $uid;?>" style="display: none;">
                  <form action="../controllers/update.php" method="POST">
                    <input type="hidden" name="uid" value="<?php echo $user['id'];?>">
                    <td class="p-2"">
                      <input type="text" name="full-name" value="<?php echo $user['fname']." ".$user['lname'];?>" class="border-2 border-gray-300 rounded-md p-1">
                    </td>
                    <td class="p-2">
                      <input type="text" name="email" value="<?php echo $user['email'];?>" class="border-2 border-gray-300 rounded-md p-1">
                    </td>
                    <td class="p-2">
                      <input type="phone" name="phone" value="<?php echo $user['phone'];?>" class="border-2 border-gray-300 rounded-md p-1 w-[6.4rem]">
                    </td>
                    <td class="p-2">
                      <select name="type" id="" required class="border-2 border-gray-300 rounded-md p-1">
                        <option value="">
                          Select Type
                        </option>
                        <?php 
                          $qry = "SELECT DISTINCT type FROM users";
                          $types = specialQuery($qry);
                          foreach($types as $type){
                            ?>
                            <option value="<?php echo $type['type'];?>">
                              <?php 
                                $te = $type['type'];
                                if($te === 'A') 
                                  echo "Admin"; 
                                elseif($te === 'B') 
                                  echo "Budgeting"; 
                                elseif($te === 'C') 
                                echo "Budget Approving";
                              ?>
                            </option>
                            <?php
                          }
                        ?>
                      </select>
                    </td>
                    <td class="p-2">
                    <select name="entity" id="" class="border-2 border-gray-300 rounded-md p-1">
                      <option value="">
                        Budgeting Depatment
                      </option>
                      <?php 
                        $entities = getData('budgeting_entities');
                        foreach($entities as $entity){
                          ?>
                          <option value="<?php echo $entity['id'];?>">
                            <?php echo $entity['name'];?>
                          </option>
                          <?php
                        }
                      ?>
                    </select>
                    </td>
                    <td class="p-2">
                      <input type="submit" value="Update" name="update-user" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    </td>
                  </form>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="relative bg-white shadow-md rounded-md p-4">
      <!-- Addd new user button -->
      <button data-modal-toggle="add-user-form" class="bg-green-800 text-white mb-2 px-1 py-2 rounded-md hover:bg-green-600 w-full">
        Add new user
      </button>
      <!-- Add user model -->
      <?php
        addUserModel();
      ?>
      <!-- add department button -->
      <button data-modal-toggle="departmentModal" class="bg-green-800 text-white mb-2 mt-2 px-1 py-2 rounded-md hover:bg-green-600 w-full">
        Add Budgeting Entity/Department
      </button>
      <!-- Add department modal -->
      <?php addDepartmentModel($users);?>
    </div>
  </div>

  <div class="w-full md:w-1/3">
    <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
      <h3 class="text-xl font-bold mb-4">Departments</h3>
      <table class="">
        <thead>
          <tr class="text-center">
            <th class="py-2">Deoartment Name</th>
            <th class="py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($entities as $entity){
              ?>
              <tr>
                <td class="p-2"><?php echo $entity['name'];?></td>
                <td class="flex gap-4 p-2">
                  <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                  <!-- delete button -->
                  <?php $model = 'entity';?>
                  <button type="button" data-modal-target="delete<?php echo $model;?>Modal" data-modal-toggle="delete<?php echo $model;?>Modal">
                    <img src="../images/delete_black_24dp.svg" alt="delete">
                  </button>
                  <?php
                    deleteModel($model, $entity['id']);
                  ?>
                </td>
                </td>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include 'includes/footer.php' ?>
<!-- <script src="../user_edit.js"></script> -->
<script>
  // Accessing elements using their IDs
  <?php foreach ($users as $user): ?>
      var main_row<?php echo $user['id']; ?> = document.getElementById('main-row<?php echo $user['id']; ?>');
      var edit_row<?php echo $user['id']; ?> = document.getElementById('edit-row<?php echo $user['id']; ?>');
      var p<?php echo $user['id']; ?> = document.getElementById('pencil<?php echo $user['id']; ?>');
      p<?php echo $user['id']; ?>.addEventListener('click', function() {
          // Perform some action when the button is clicked
          main_row<?php echo $user['id']; ?>.style.display = 'none';
          edit_row<?php echo $user['id']; ?>.style.display = 'table-row';
      });
  <?php endforeach; ?>
  // toggling between showing the add-user-form and add-entity-form
  //variables for add-user button and form elements
  // let u_a_btn = document.getElementById('add-user-btn');
  // let u_a_frm = document.getElementById('add-user-form');
  // //variables for add-entity button and form elements 
  // let u_e_btn = document.getElementById('add-entity-btn');
  // let u_e_frm = document.getElementById('add-entity-form');
  // //show the add-user form and hide the add-entity one when add-user button is clicked
  // u_a_btn.addEventListener('click', function(){
  //   u_a_frm.style.display = 'block';
  //   u_e_frm.style.display = 'none';
  // });
  // //show the add-entity form and hide the add-user one when add-entity button is clicked
  // u_e_btn.addEventListener('click', function(){
  //   u_e_frm.style.display = 'block';
  //   u_a_frm.style.display = 'none';
  // });
</script>
