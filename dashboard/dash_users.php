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
              <tr>
                <td class="p-2">User 1</td>
                <td class="p-2">test@test.org</td>
                <td class="p-2">+25678897789878</td>
                <td class="p-2">Budget</td>
                <td class="p-2">main farm</td>
                <td class="flex gap-4 p-2">
                  <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit"></a>
                  <a href="#"><img src="../images/delete_black_24dp.svg" alt="delete"></a>
                </td>
              </tr>
              <!-- User Row 2 -->
              <!-- Add more user rows here -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Add User Form -->
      <div class="bg-white shadow-md rounded-md p-4">
        <h3 class="text-lg font-bold mb-4">Add User</h3>
        <?php
            include "../msg.php";
        ?>
        <form class="flex flex-col">
          <div class="mt-4">
            <label for="fname" class="block">First Name:</label>
            <input type="text" name="fname" id="fname" class="border-2 border-gray-300 rounded-md p-1">
          </div>
          <div class="mt-4">
            <label for="lname" class="block">Last Name:</label>
            <input type="text" name="lname" id="lname" class="border-2 border-gray-300 rounded-md p-1">
          </div>
          <div class="mt-4">
            <label for="email" class="block">Email:</label>
            <input type="email" name="email" id="email" class="border-2 border-gray-300 rounded-md p-1">
          </div>
          <div class="mt-4">
            <label for="password" class="block">Password:</label>
            <input type="password" name="password" id="password" class="border-2 border-gray-300 rounded-md p-1">
          </div>
          <div class="mt-4">
            <label for="phone" class="block">Phone Number:</label>
            <input type="tel" name="phone" id="phone" class="border-2 border-gray-300 rounded-md p-1">
          </div>
          <div class="mt-4">
            <label for="dob" class="block">Date of Birth:</label>
            <input type="date" name="dob" id="dob" class="border-2 border-gray-300 rounded-md p-1">
          </div>
          <div class="mt-4">
            <label for="role" class="block">Role:</label>
            <input type="radio" name="role" id="roleA" value="A" class="border-2 border-gray-300 rounded-md p-1"> Admin
            <input type="radio" name="role" id="roleB" value="B" class="border-2 border-gray-300 rounded-md p-1"> Budgeting
          </div>
          <div class="mt-4">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Add User</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php' ?>