<?php 
  include 'includes/header.php';
  include "../controllers/models.php";
  include "../controllers/msg.php";           
?>
<!-- Container -->
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
              <th class="p-2 text-center">Name</th>
              <th class="p-2 text-center">Email</th>
              <th class="p-2 text-center">Phone</th>
              <th class="p-2 text-center">Role</th>
              <th class="p-2 text-center">Department</th>
              <th class="p-2 text-center">Actions</th>
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
                  <td class="p-2 text-center"><?php echo $user['fname']." ".$user['lname'];?></td>
                  <td class="p-2 text-center"><?php echo $user['email'];?></td>
                  <td class="p-2 text-center"><?php echo $user['phone'];?></td>
                  <td class="p-2 text-center">
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
                  <td class="p-2 text-center"><?php echo $dpt;?></td>
                  <td class="flex justify-center gap-4 p-2">
                    <button type="button"><img src="../images/edit_black_24dp.svg" alt="edit" data-modal-target="pencil<?php echo $uid;?>" data-modal-toggle="pencil<?php echo $uid;?>"></button>
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
          </tbody>
        </table>
                <!-- the row to display an edit form for user info -->
                <!-- Edit modal starts here -->
                <div id="pencil<?php echo $uid;?>" data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                  <div class="relative w-full max-w-md">

                    <div class="relative bg-white rounded-lg shadow ">
                      <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="pencil<?php echo $uid;?>">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                      <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-bold text-green-900">Edit User</h3>
                        <form action="../controllers/update.php" method="POST" class="">
                          <input type="hidden" name="uid" value="<?php echo $user['id'];?>">

                          <div class="flex gap-2 p-2"">
                            <input type="text" name="fname" value="<?php echo $user['fname'];?>" class="w-full border-2 border-gray-300 rounded-md p-1">
                            <input type="text" name="lname" value="<?php echo $user['lname'];?>" class="w-full border-2 border-gray-300 rounded-md p-1">
                          </div>

                          <div class="p-2">
                            <input type="text" name="email" value="<?php echo $user['email'];?>" class="w-full border-2 border-gray-300 rounded-md p-1">
                          </div>

                          <div class="p-2">
                            <input type="phone" name="phone" value="<?php echo $user['phone'];?>" class="w-full border-2 border-gray-300 rounded-md p-1 w-[6.4rem]">
                          </div>

                          <div class="p-2">
                            <select name="type" id="" required class="w-full border-2 border-gray-300 rounded-md p-1">
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
                          </div>
                          <div class="p-2">
                          <select name="entity" id="" class="w-full border-2 border-gray-300 rounded-md p-1">
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
                          </div>
                          <div class="p-2">
                            <input type="submit" value="Update" name="update-user" class="w-full bg-green-900 text-white px-4 py-2 rounded-md hover:bg-green-600">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              }
            ?>
            <!-- edit modal ends here -->
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
            <th class="py-2">Department Name</th>
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
<!-- <script>
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
</script> -->
