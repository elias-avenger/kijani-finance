<?php
  include "../controllers/db/queries.php";
  //$users = getData('users');
  if(!isset($_SESSION['email']))
    header("location:../index.php");

  $user_data = mysqli_fetch_array(getUser($_SESSION['email']));
  if($user_data['type'] !== 'A')
    header("location:../index.php");
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kijani Forestry</title>
  <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
  
</head>

<body>
  <!-- Header -->
  <header class="bg-gray-900 text-white p-4" style="background-color: #235F3D;">
    <div class="container mx-auto flex justify-between items-center">
      <a href="#"><img src="../images/logo-1.png" alt="" class="h-8"></a>
      <nav class="hidden md:block">
        <ul class="flex space-x-4">
          <li><a href="dashboard.php" class="hover:text-gray-300">Home</a></li>
          <li><a href="dash_budgets.php" class="hover:text-gray-300">Budgets</a></li>
          <li><a href="dash_items.php" class="hover:text-gray-300">Items</a></li>
          <li><a href="dash_users.php" class="hover:text-gray-300">Users</a></li>
          <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white rounded md:border-0 md:p-0 md:w-auto"><?php echo $user_data['fname']." ".$user_data['lname'];?><svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="../controllers/logout.php" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-white">Logout</a>
                </div>
            </div>
          </li>
          
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
      <li><a href="dashboard.php" class="hover:text-gray-300">Home</a></li>
      <li><a href="dash_budgets.php" class="hover:text-gray-300">Budgets</a></li>
      <li><a href="dash_items.php" class="hover:text-gray-300">Items</a></li>
      <li><a href="dash_users.php" class="hover:text-gray-300">Users</a></li>
      <li>
        <button id="dropdownNavbarLink" data-modal-target="staticModal" data-modal-toggle="staticModal" class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-white rounded md:border-0 md:p-0 md:w-auto"><?php echo $user_data['fname']." ".$user_data['lname'];?><svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
        <!-- Dropdown menu -->
        <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    <?php echo $user_data['fname']." ".$user_data['lname'];?>
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                  </button>
              </div>
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                <li>
                  <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                </li>
              </ul>
              <div class="py-1">
                <a href="../controllers/logout.php" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-white">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
