<?php 
  include 'includes/header.php';
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
                  <tr id="main-row<?php echo $uid;?>" style="display: table-row;">
                    <td class="p-2"><?php echo $user['fname']." ".$user['lname'];?></td>
                    <td class="p-2"><?php echo $user['email'];?></td>
                    <td class="p-2"><?php echo $user['phone'];?></td>
                    <td class="p-2"><?php echo ($user['type'] === 'A'? "Admin": "Budgeting");?></td>
                    <td class="p-2"><?php echo $dpt;?></td>
                    <td class="flex gap-4 p-2">
                      <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                      <form action="../controllers/delete.php" method="POST">
                        <input type="hidden" value="<?php echo $user['id'];?>" name="id">
                        <button type="submit" name="delete_user">
                          <img src="../images/delete_black_24dp.svg" alt="delete">
                        </button>
                      </form>
                    </td>
                  </tr>
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
                        <input type="phone" name="phone" value="<?php echo $user['phone'];?>" class="border-2 border-gray-300 rounded-md p-1">
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

      <!-- Add User Form -->
      <div class="bg-white shadow-md rounded-md p-4">
        <h3 class="text-lg font-bold mb-4">Add User</h3>
        <?php
            include "../controllers/msg.php";
        ?>
        <form class="flex flex-col" action="../controllers/submit.php" method="POST">
          <div class="mt-4">
            <label for="fname" class="block">First Name:</label>
            <input type="text" name="fname" id="fname" class="border-2 border-gray-300 rounded-md p-1" required>
          </div>
          <div class="mt-4">
            <label for="lname" class="block">Last Name:</label>
            <input type="text" name="lname" id="lname" class="border-2 border-gray-300 rounded-md p-1" required>
          </div>
          <div class="mt-4">
            <label for="email" class="block">Email:</label>
            <input type="email" name="email" id="email" class="border-2 border-gray-300 rounded-md p-1" required>
          </div>
          <div class="mt-4">
            <label for="password" class="block">Password:</label>
            <input type="password" name="password" id="password" class="border-2 border-gray-300 rounded-md p-1" required>
          </div>
          <div class="mt-4">
              <label class="block " for="conf_password">Confirm Password:</label>
              <input name="conf_password" type="password" placeholder="Re-enter your password" class="border-2 border-gray-300 rounded-md p-1" required>
            </div>
          <div class="mt-4">
            <label for="phone" class="block">Phone Number:</label>
            <input type="tel" name="phone" id="phone" class="border-2 border-gray-300 rounded-md p-1" required>
          </div>
          <div class="mt-4">
            <label for="dob" class="block">Date of Birth:</label>
            <input type="date" name="dob" id="dob" class="border-2 border-gray-300 rounded-md p-1" required>
          </div>
          <div class="mt-4">
            <label for="role" class="block">Role:</label>
            <input type="radio" name="role" id="roleA" value="A" class="border-2 border-gray-300 rounded-md p-1" required> Admin
            <input type="radio" name="role" id="roleB" value="B" class="border-2 border-gray-300 rounded-md p-1" required> Budgeting
          </div>
          <div class="mt-4">
            <input type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600" name="add-user" value="Add User">
          </div>
        </form>
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
</script>
