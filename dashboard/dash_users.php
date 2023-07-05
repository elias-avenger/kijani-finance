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
              <th class="p-2 text-center">Business Unit</th>
              <!-- <th class="p-2 text-center">Uid</th> -->
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
                  <!-- <td class="p-2"><?php //echo $uid;?></td> -->
                  <td class="flex justify-center gap-4 p-2">
                    <!-- edit button -->
                    <button type="button">
                      <img src="../images/edit_black_24dp.svg" alt="edit" data-modal-target="pencil<?php echo $uid;?>" data-modal-toggle="pencil<?php echo $uid;?>">
                    </button>
                    <!-- edit modal -->
                    <?php
                      $entities = getData('budgeting_entities');
                      editUserModel($uid, $user, $entities);
                    ?>
                    <!-- delete button -->
                    <?php $model = 'user';?>
                    <button type="button" data-modal-target="delete<?php echo $model;?>Modal<?php echo $uid;?>" data-modal-toggle="delete<?php echo $model;?>Modal<?php echo $uid;?>">
                      <img src="../images/delete_black_24dp.svg" alt="delete">
                    </button>
                    <!-- delete modal -->
                    <?php
                      //echo $uid;
                      deleteModel($model, $uid);
                    ?>
                  </td>
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
        $b_users = specialQuery("SELECT id FROM users WHERE type = 'B'");
        if(!empty($b_users)){
          ?>
          <!-- add department button -->
          <button data-modal-toggle="departmentModal" class="bg-green-800 text-white mb-2 mt-2 px-1 py-2 rounded-md hover:bg-green-600 w-full">
            Add Business Unit
          </button>
          <!-- Add department modal -->
          <?php 
            addDepartmentModel($users);
        }
      ?>
    </div>
  </div>

  <div class="w-full md:w-1/3">
    <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
      <h3 class="text-xl font-bold mb-4">Business Units</h3>
      <table class="">
        <thead>
          <tr class="text-center">
            <th class="py-2">Unit Name</th>
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
                  <?php $model = 'unit';?>
                  <button type="button" data-modal-target="delete<?php echo $model;?>Modal<?php echo $entity['id'];?>" data-modal-toggle="delete<?php echo $model;?>Modal<?php echo $entity['id'];?>">
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
