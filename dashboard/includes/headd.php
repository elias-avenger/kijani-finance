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
    <title>Dashboard - kijani Forestry</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css"  rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-200">
    <div class="flex flex-col md:flex-row p-4 gap-4">
        <nav class="hidden md:flex flex-col w-1/6 bg-white rounded-lg h-fit px-4 pb-8 pt-4">
            <a href="dashboard.php" class="flex p-2 mb-4">
                <img src="../images/KF_icon.png" class="w-12" alt="">
                <span class="px-2 pt-2 text-2xl text-green-900 font-bold">Kijani Forestry</span>
            </a>

            <hr class="border-1 border-gray-600 rounded-xl mb-8">
            <div class="flex flex-col mt-8 mb-48">
                <a href="dashboard.php" class="px-4 text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg border-t">
                <i class="fa fa-th-large"></i> Dashboard</a>

                <div id="accordion-collapse" data-accordion="collapse">
                    <h2 id="accordion-collapse-heading-1" class="text-black">
                        <span type="button" class="flex items-center w-full justify-between px-4 text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg" data-accordion-target="#accordion-collapse-body-1" aria-expanded="false" aria-controls="accordion-collapse-body-1">
                            <span class="text-lg hover:bg-green-900 hover:text-white rounded-lg "><i class="fa fa-money"></i> Budgets</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </span>
                    </h2>
                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                        <div class="flex flex-col p-2 bg-gray-100">
                            <a href="dash_budgets.php" class="px-4  text-lg mb-4 py-2 bg-blue-500 text-white rounded-lg"><i class="fa fa-check"></i> Approved Budgets</a>
                            <a href="dash_budgets.php" class="px-4 text-lg mb-4 py-2 bg-red-500 text-white rounded-lg"><i class="fa fa-spinner"></i> Pending Budgets</a>
                        </div>
                    </div>
                </div>


                <a href="dash_items.php" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg border-t"><i class="fa fa-list-alt"></i> Items</a>
                <a href="#" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg border-t"><i class="fa fa-globe"></i> Departments</a>
                <a href="dash_users.php" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg border-t"><i class="fa fa-users"></i> Users</a>
                <a href="#" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg border-y"><i class="fa fa-cogs"></i>  Settings</a>
            </div>

            <div class="flex flex-col px-4 mb-4">
                <a href="../controllers/logout.php" class="text-red-500 text-xl"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
            <hr class="w-full border-1 border-green-900 rounded-full">
            <div class="flex w-full py-4">
                &copy; <span id="coppy"></span>  Kijani Forestry Finance
            </div>
        </nav>
        <!-- mobile menu -->
        <div class="hidden md:hidden fixed w-full mt-16 left-0 p-4 bg-green-900 z-50 border-1 border-red-500 rounded-xl" id="menu">
            <ul class="flex flex-col text-white">
                <a href="dashboard.php" class="px-4 text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg ">
                    <i class="fa fa-th-large"></i> Dashboard
                </a>
                <div id="accordion-collapse" data-accordion="collapse">
                    <h2 id="accordion-collapse-budget" class="text-white">
                        <span type="button" class="flex items-center w-full justify-between px-4 text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-1">
                            <span class="text-lg hover:bg-green-900 hover:text-white rounded-lg "><i class="fa fa-money"></i> Budgets</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </span>
                    </h2>
                    <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-budget">
                        <div class="flex flex-col p-2 bg-gray-100 rounded-xl">
                            <a href="dash_budgets.php" class="px-4  text-lg mb-4 py-2 bg-blue-500 text-white rounded-lg"><i class="fa fa-check"></i> Approved Budgets</a>
                            <a href="dash_budgets.php" class="px-4 text-lg mb-4 py-2 bg-red-500 text-white rounded-lg"><i class="fa fa-spinner"></i> Pending Budgets</a>
                        </div>
                    </div>
                </div>
                <a href="dash_items.php" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg "><i class="fa fa-list-alt"></i> Items</a>
                <a href="#" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white "><i class="fa fa-globe"></i> Departments</a>
                <a href="dash_users.php" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg"><i class="fa fa-users"></i> Users</a>
                <a href="#" class="px-4  text-lg mb-4 py-2 hover:bg-green-900 hover:text-white rounded-lg"><i class="fa fa-cogs"></i>  Settings</a>
                <hr class="border border-white rounded-full">
                <div class="flex flex-col px-4 my-4">
                    <a href="../controllers/logout.php" class="text-red-500 text-xl"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </ul>
        </div>
       
        <!-- main content -->
        <div class="md:w-5/6 rounded-lg h-max">
             <!-- upper bar -->
            <div class="fixed md:relative top-0 left-0 flex justify-between md:justify-end items-center w-full rounded-lg  bg-green-900 shadow p-2">
                 <!-- mobile menu button -->
                <i class="fa fa-bars text-2xl text-white pl-4 md:hidden" id="openBtn" onclick="openM()"></i>
                <i class="fa fa-times-circle text-2xl text-white pl-4 hidden   md:hidden" id="closeBtn" onclick="closeM()"></i>
                <a href="#" class="flex p-2">
                    <img src="https://media.licdn.com/dms/image/C5103AQFl656k2-DwOg/profile-displayphoto-shrink_800_800/0/1517034956958?e=2147483647&v=beta&t=6H_aZri3qcbtlgwTyTKBceuyTEPYW43xGViq5UL4J-w" alt="" class="w-8 h-8 rounded-full">
                    <div class="hidden md:flex flex-col px-4">
                        <h4 class="text-lg  font-bold uppercase text-white"><?php echo $user_data['fname']." ".$user_data['lname'];?></h4>
                    </div>
                </a>
            </div>


           