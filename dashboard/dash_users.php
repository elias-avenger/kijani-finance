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
                    <td class="p-2"><?php echo ($user['type'] === 'A'? "Admin": "Budgeting");?></td>
                    <td class="p-2"><?php echo $dpt;?></td>
                    <td class="flex gap-4 p-2">
                      <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                      <!-- delete button -->
                        <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal">
                          <img src="../images/delete_black_24dp.svg" alt="delete">
                        </button>
                        <!-- delete modal -->
                        <?php
                          $model = 'user';
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
                                <?php echo $type['type']==='A'?'Admin':'Budgeting';?>
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
        <!-- <h3 class="text-lg font-bold mb-4">Add User</h3> -->
        
        <!-- Add user model -->
        <div id="add-user-form" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- close modal  button -->
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="add-user-form">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
              <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-bold text-green-800 dark:text-white">Enter new user details below</h3>

                <!-- Add User Form -->
                <form  action="../controllers/submit.php" method="POST">
                  <div class="flex flex-col w-full">
                    <div class="flex flex-col md:flex-row gap-2">
                      <div class="mt-4 md:w-1/2">
                        <label for="fname" class="block">First Name:</label>
                        <input type="text" name="fname" id="fname" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" required>
                      </div>
                      <div class="mt-4 md:w-1/2">
                        <label for="lname" class="block">Last Name:</label>
                        <input type="text" name="lname" id="lname" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" required>
                      </div>
                    </div>
                    <div class="mt-4">
                      <label for="email" class="block">Email:</label>
                      <input type="email" name="email" id="email" class="w-full border-2 border-green-900 rounded-md p-1" required>
                    </div>
                    <div class="flex flex-col md:flex-row gap-2">
                      <div class="mt-4">
                        <label for="password" class="block">Password:</label>
                        <input type="password" name="password" id="password" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" required>
                      </div>
                      <div class="mt-4">
                        <label class="block " for="conf_password">Confirm Password:</label>
                        <input name="conf_password" type="password" placeholder="Re-enter your password" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" required>
                      </div>
                    </div>
                    <div class="mt-4">
                      <label for="phone" class="block">Phone Number:</label>
                      <input type="tel" name="phone" id="phone" class="w-full border-2 border-green-900 rounded-md p-1" required>
                    </div>
                    <div class="mt-4">
                      <label for="dob" class="block">Date of Birth:</label>
                      <input type="date" name="dob" id="dob" class="w-full border-2 border-green-900 rounded-md p-1" required>
                    </div>
                    <div class="mt-4">
                      <label for="role" class="block">Role:</label>
                      <input type="radio" name="role" id="roleA" value="A" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required> Admin
                      <input type="radio" name="role" id="roleB" value="B" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required> Budgeting
                    </div>
                    <div class="mt-4">
                      <input type="submit" class="w-full bg-green-900 text-white px-4 py-2 rounded-md hover:bg-green-600" name="add-user" value="Add User">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- add department button -->
        <button data-modal-toggle="departmentModal" class="bg-green-800 text-white mb-2 mt-2 px-1 py-2 rounded-md hover:bg-green-600 w-full">
          Add Budgeting Entity/Department
        </button>

        <!-- Add department modal -->
        <div id="departmentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="departmentModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
              </button>
              <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Register a Department</h3>
                <!-- Add department form-->
                <form id="add-entity-form" class="relative z-50 flex flex-col" action="../controllers/submit.php" method="POST">
                  <?php
                      include "../controllers/msg.php";
                  ?>
                  <div class="mt-4">
                    <label for="e-name" class="block">Entity/Department Name:</label>
                    <input type="text" name="e-name" id="e-name" class="w-full border-2 border-green-900 rounded-md p-1" required>
                  </div>
                  <div class="mt-4">
                    <label for="e-description" class="block">Description:</label>
                    <textarea name="e-description" id="e-description" cols="40" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-green-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                  </div>
                  <div class="mt-4">
                    <label for="incharge" class="block">User Incharge</label>
                    <select name="incharge" id="incharge" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-green-900 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                      <option value="">Select User</option>
                      <?php
                      foreach($users as $user){
                        //if($user['type']!='A'){
                        ?>
                        <option value="<?php echo $user['id'];?>">
                          <?php echo $user['fname']." ".$user['lname'];?>
                        </option>
                        <?php
                        //}
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mt-4">
                    <input type="submit" class="w-full bg-green-900 text-white px-4 py-2 rounded-md hover:bg-green-600" name="add-entity" value="Add Entity">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="w-full md:w-1/3">
        <div class="bg-white  shadow-md rounded-md p-4">
          <h3 class="text-xl font-bold mb-4">Departments</h3>
          <table class="">
            <thead>
              <tr class="text-center">
                <th class="py-2">Department Name</th>
                <th class="py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="p-2">Department 1</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Department 2</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Department 3</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Department 4</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Department 5</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

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
    let u_a_btn = document.getElementById('add-user-btn');
    let u_a_frm = document.getElementById('add-user-form');
    //variables for add-entity button and form elements 
    let u_e_btn = document.getElementById('add-entity-btn');
    let u_e_frm = document.getElementById('add-entity-form');
    //show the add-user form and hide the add-entity one when add-user button is clicked
    u_a_btn.addEventListener('click', function(){
      u_a_frm.style.display = 'block';
      u_e_frm.style.display = 'none';
    });
    //show the add-entity form and hide the add-user one when add-entity button is clicked
    u_e_btn.addEventListener('click', function(){
      u_e_frm.style.display = 'block';
      u_a_frm.style.display = 'none';
    });
</script>
