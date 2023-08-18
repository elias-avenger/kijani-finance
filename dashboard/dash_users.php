<?php 
  include 'includes/header.php';
  include "../controllers/models.php";
  include "../controllers/msg.php";           
?>
<!-- Container -->
<section class="w-full">
  <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

    <div class="bg-gradient-to-b from-green-900 to-green-400 pt-3">
      <div class="rounded-tl-3xl bg-gradient-to-r from-green-900 to-green-400 p-4 shadow text-2xl text-white">
        <h1 class="font-bold pl-2">Users</h1>
      </div>
    </div>

    <div class="flex flex-wrap p-6">
      <div class="relative bg-white shadow-md rounded-md p-4">
        <button data-modal-toggle="add-user-form" class="bg-green-800 text-white mb-2 px-2 py-2 rounded-md hover:bg-green-600 m-2">
          Add new user
        </button>
        <!-- Add user model -->
        <?php
          $users = getData('users');
          addUserModel();
        ?>
      </div>
    </div>
    <div class="flex flex-row flex-wrap flex-grow mt-2">
          
      <div class="w-full md:w-2/3 pt-6 pb-6 md:p-6">
        <!--Table Card-->
        <div class="bg-white border-transparent rounded-lg shadow-xl">
          <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
              <h2 class="font-bold uppercase text-gray-600">Registered Users</h2>
          </div>
          <div class="p-5 overflow-x-auto">
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
                  foreach($users as $user){
                    $uid = $user['id'];
                    $user_depts = getDepartment($uid);
                    if(count($user_depts) > 0){
                      $dept_names = [];
                      foreach($user_depts as $user_dept)
                        array_push($dept_names, $user_dept['name']);
                      $depts = implode(", ", $dept_names);
                    }
                    else{
                      $depts = "Not Assigned";
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
                      <td class="p-2"><?php echo $depts;?></td>
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
        <!--/table Card-->
      </div>

    </div>
  </div>
</section>
<?php include 'includes/footer.php' ?>
