<?php
  include "../controllers/db/queries.php";
  //$users = getData('users');
  if(!isset($_SESSION['email']))
    header("location:../index.php");

  $user_data = mysqli_fetch_array(getUser($_SESSION['email']));
  if($user_data['type'] !== 'A')
    header("location:../index.php");
    
  echo $user_data['fname']." ".$user_data['lname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kijani Forestry</title>
  <link rel="icon" type="image/x-icon" href="../images/KF_icon.png">
  <!-- Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
  
</head>

<body>
  <!-- Header -->
  <header class="bg-gray-900 text-white p-4" style="background-color: #235F3D;">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">Dashboard</h1>
      <nav class="hidden md:block">
        <ul class="flex space-x-4">
          <li><a href="dashboard.php" class="hover:text-gray-300">Home</a></li>
          <li><a href="dash_budget.php" class="hover:text-gray-300">Budgets</a></li>
          <li><a href="dash_category.php" class="hover:text-gray-300">Category</a></li>
          <li><a href="#" class="hover:text-gray-300">Profile</a></li>
          <li><a href="dash_users.php" class="hover:text-gray-300">Users</a></li>
          <li><a href="../controllers/logout.php" class="hover:text-gray-300">Logout</a></li>
        </ul>
      </nav>
      <div class="md:hidden">
        <button id="mobile-menu-button" class="text-white focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </header>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden bg-gray-900 text-white py-4 px-6">
    <ul class="flex flex-col space-y-4">
      <li><a href="#" class="hover:text-gray-300">Home</a></li>
      <li><a href="#" class="hover:text-gray-300">Budgets</a></li>
      <li><a href="#" class="hover:text-gray-300">Proposals</a></li>
      <li><a href="#" class="hover:text-gray-300">Profile</a></li>
      <li><a href="#" class="hover:text-gray-300">Users</a></li>
      <li><a href="#" class="hover:text-gray-300">Logout</a></li>
    </ul>
  </div>
