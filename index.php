<?php
    include "controllers/db/queries.php";
    $users = getData('users');
    if(empty($users)){
        header("location:admin_signup.php");
    }
    else
      echo count($users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kijani Forestry</title>
  <link rel="icon" type="image/x-icon" href="images/KF_Green_Icon.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

  <div class="min-h-screen flex flex-col items-center justify-center bg-green-900" style="background-color: #235F3D;">
    <img src="images/logo-1.png" class="mb-4 w-96" alt="logo">
    <div class="max-w-md w-full mx-auto p-4">
        <?php
            include "controllers/msg.php";
        ?>
      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="controllers/login.php" method="POST">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password:</label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="flex items-center justify-between">
        <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="background-color: #235F3D;" type="submit" name="login" value="Log In">
        </div>
      </form>
      
    </div>
  </div>
  
</body>
</html>
