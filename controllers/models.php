<?php
    function deleteModel($model_name, $mid){
        ?>
        <!-- delete modal -->
        <div id="delete<?php echo $model_name;?>Modal<?php echo $mid;?>" data-modal-backdrop="static" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-green-900 rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-white bg-transparent hover:bg-white hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="delete<?php echo $model_name;?>Modal<?php echo $mid;?>">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-white w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-white ">Are you sure you want to delete this <?php echo $model_name;?>?</h3>
                        <form action="../controllers/delete.php" method="POST" class="inline-flex">
                            <input type="hidden" value="<?php echo $mid;?>" name="did">
                            <button name="delete_<?php echo $model_name;?>" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-hide="delete<?php echo $model_name;?>Modal<?php echo $mid;?>" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    function addItemModel($categories, $entities){
        ?>
        <div class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" id="itemModal" data-modal-backdrop="static">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="bg-green-900 rounded-t-lg text-white p-4 mt-2 ">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="itemModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                        <h3 class="mb-4 text-xl font-medium text-white ">Add Item </h3>
                    </div>
                    <div class="px-6 py-6 lg:px-8">
                        <form class="mx-auto flex flex-col" action="../controllers/submit.php" method="POST">
                            <div class="mb-2 mt-2">
                                <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="i-name" name="i-name" type="text" placeholder="Enter Item name" required>
                            </div>
                            <div class="mb-2 mt-2">
                                <textarea name="description" id="" cols="40" rows="3" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter item Description"></textarea>
                            </div>
                            <div class="mb-2 mt-2">
                                <select class="border rounded w-full py-2 px-3 text-gray-700" name="category" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach($categories as $category){
                                        ?>
                                        <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="flex flex-col text-green-900 font-bold m-4">
                                <label class="text-xl">Select applicable Business Unit(s):</label>
                                <?php
                                foreach($entities as $entity){
                                    $e_id = $entity['id'];
                                    ?>
                                    <div class="m-1">
                                        <input type="checkbox" id="check<?php echo $e_id;?>" class="w-4 h-4 text-green-900 bg-gray-100 border-gray-300 rounded focus:ring-green-900  focus:ring-2" value="<?php echo $e_id;?>" name="entity[]" onclick="showEntity()"> <?php echo $entity['name'];?>
                                    </div>
                                    <div id="entity<?php echo $e_id;?>" style="display: none;">
                                        <div class="mb-2 mt-2">
                                            <input id="unit<?php echo $e_id;?>" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="unit[]" type="text" placeholder="Unit" required>
                                        </div>
                                        <div class="mb-2 mt-2">
                                            <textarea name="justification[]" id="just<?php echo $e_id;?>" cols="40" rows="3" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Justification (How, Why... this item, unit,... )"></textarea>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="flex items-center">
                                <input type="submit" value="Add Item" name="add-item" class="w-full bg-green-900 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:shadow-outline">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function addCategoryModel(){
        ?>
        <div class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" id="categoryModal" data-modal-backdrop="static">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="bg-green-900 rounded-t-lg text-white p-4 mt-2 ">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-red-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="categoryModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                        <h3 class="mb-4 text-xl font-medium text-white">Add Item Category</h3>
                    </div>
                    <div class="px-6 py-6 lg:px-8 text-green-900 font-bold">
                        <form id="" class="mx-auto flex flex-col " action="../controllers/submit.php" method="POST">
                            <font class="">
                                Category Name:
                            </font>
                            <div class="mb-4">
                                <input class="border rounded w-full py-2 px-3 text-gray-700 focus:shadow-outline" id="categoryName" name="cat-name" type="text" placeholder="Enter category name" required>
                            </div>
                            <font class="">
                                Description:
                            </font>
                            <div class="mb-4">
                                <textarea name="description" id="" cols="40" rows="3" class="border rounded w-full py-2 px-3 text-gray-700 focus:shadow-outline"></textarea>
                            </div>
                            <div class="flex items-center mt-2">
                                <input type="submit" value="Add Category" name="add-category" class="w-full bg-green-900 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:shadow-outline">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function addUserModel(){
        ?>
        <div id="add-user-form" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden  w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- close modal  button -->
                    <div class="bg-green-900 rounded-t-lg text-white p-4 mt-2 ">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-red-400 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="add-user-form">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <h3 class="mb-4 text-xl font-bold text-white">Enter new user details below</h3>
                    </div>
                    <div class="px-6 py-6 lg:px-8">
                        <!-- Add User Form -->
                        <form  action="../controllers/submit.php" method="POST">
                            <div class="flex flex-col w-full text-green-900 font-bold">
                                <font class="">
                                    Name:
                                </font> 
                                <div class="mb-4 flex flex-col md:flex-row gap-2">
                                    <div class="md:w-1/2">
                                        <input type="text" name="fname" id="fname" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" placeholder="First Name" required>
                                    </div>
                                    <div class="md:w-1/2">
                                        <input type="text" name="lname" id="lname" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" placeholder="Last Name" required>
                                    </div>
                                </div>
                                <font class="">
                                    Email:
                                </font>
                                <div class="mb-4">
                                    <input type="email" name="email" id="email" class="w-full border-2 border-green-900 rounded-md p-1" placeholder="Email" required>
                                </div>
                                <font class="">
                                    Password:
                                </font>
                                <div class="flex flex-col md:flex-row gap-2">
                                    <div class="mb-4">
                                        <input type="password" name="password" id="password" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" placeholder="Password" required>
                                    </div>
                                    <div class="mb-4">
                                        <input name="conf_password" type="password" placeholder="Re-enter your password" class="w-full md:w-48 border-2 border-green-900 rounded-md p-1" required>
                                    </div>
                                </div>
                                <font class="">
                                    Phone Number:
                                </font>
                                <div class="mb-4">
                                    <input type="tel" name="phone" id="phone" class="w-full border-2 border-green-900 rounded-md p-1" placeholder="Phone Number" required>
                                </div>
                                <font class="">
                                    Date of Birth:
                                </font>
                                <div class="mb-4">
                                    <input type="date" name="dob" id="dob" class="w-full border-2 border-green-900 rounded-md p-1" placeholder="Date of Birth" required>
                                </div>
                                <font class="">
                                    Role:
                                </font>
                                <div class="mb-4">
                                    <input type="radio" name="role" id="roleA" value="A" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required> Admin
                                    <input type="radio" name="role" id="roleB" value="B" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required> Budgeting
                                    <input type="radio" name="role" id="roleC" value="C" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required> Budget Approving
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
        <?php
    }

    function addDepartmentModel($users){
        ?>
        <div id="departmentModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="bg-green-900 rounded-t-lg text-white p-4 mt-2 ">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-red-400 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="departmentModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <h3 class="mb-4 text-xl font-bold text-white dark:text-white">Register a Business Unit</h3>
                </div>
              <div class="px-6 py-6 lg:px-8 text-green-900 font-bold">
                
                <!-- Add department form-->
                <form id="add-entity-form" class="relative z-50 flex flex-col" action="../controllers/submit.php" method="POST">
                    <font class="">
                        Unit Name:
                    </font>
                    <div class="mb-4">
                        <input type="text" name="e-name" id="e-name" class="w-full border-2 border-green-900 rounded-md p-1" required>
                    </div>
                    <font class="">
                        Description:
                    </font>
                    <div class="mb-4">
                        <textarea name="e-description" id="e-description" cols="40" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-green-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <font class="">
                        User in Charge:
                    </font>
                    <div class="mb-4">
                        <select name="incharge" id="incharge" class="block py-2.5 px-0 w-full bg-transparent border-0 border-b-2 border-green-900 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
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
                    <input type="submit" class="w-full bg-green-900 text-white px-4 py-2 rounded-md hover:bg-green-600" name="add-entity" value="Add Unit">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php
    }

    function addBPeriodModel(){
        ?>
        <div class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" id="bPeriodModal" data-modal-backdrop="static">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="bg-green-900 rounded-t-lg text-white p-4 mt-2 ">
                        <button type="button" class="absolute top-3 right-2.5 text-green-900 bg-gray-200 hover:bg-red-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="bPeriodModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <h3 class="mb-4 text-xl font-medium text-white">Budgeting Period</h3>
                    </div>
                    <div class="px-6 py-6 lg:px-8">
                        <form id="" class="mx-auto flex  flex-col" action="../controllers/submit.php" method="POST">
                            <div class="p-2">
                                <label class="block text-sm font-bold mb-2 text-green-900" for="period">Period Type:</label>
                                <select class="w-full border-2 border-gray-300 rounded-md p-1" id="b-period" name="p-type" required>
                                    <option value="W">Weekly</option>
                                    <option value="F">Fortnightly</option>
                                </select>
                            </div>
                            <div class="p-2">
                                <label for="p-from" class="block text-green-900 font-bold">From:</label>
                                <input type="date" name="p-from" id="p-from" class="w-full border-2 border-gray-300 rounded-md p-1" required>
                            </div>
                            <div class="p-2">
                                <label for="p-to" class="block text-green-900 font-bold">To:</label>
                                <input type="date" name="p-to" id="p-to" class="w-full border-2 border-gray-300 rounded-md p-1" required>
                            </div>
                            <div class="p-2">
                                <label for="days" class="block text-green-900 font-bold">Deadline:</label>
                                <input type="number" name=days" id="days" min="0" max="20" class="w-1/4 border-2 border-gray-300 rounded-md p-1" required> 
                                <font class="text-green-900 font-bold">days before start</font>
                            </div>
                            <div class="flex items-center mt-4">
                                <input type="submit" value="Add Period" name="add-bperiod" class="w-full bg-green-900 text-white mx-4 py-2 rounded-md hover:bg-green-600">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function editUserModel($uid, $user, $b_entities){
        ?>
        <!-- Edit modal starts here -->
        <div id="pencil<?php echo $uid;?>" data-modal-backdrop="static" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow ">
                    <div class="bg-green-900 rounded-t-lg text-white p-4 mt-2 ">
                        <button type="button" class="absolute top-3 right-2.5 text-green-900 bg-gray-200 hover:bg-red-400 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="pencil<?php echo $uid;?>">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <h3 class="mb-4 text-xl font-bold">Edit User (<?php echo $user['fname']." ".$user['lname'];?>)</h3>
                    </div>
                    <div class="px-6 py-6 lg:px-8">
                        <form action="../controllers/update.php" method="POST" class="">
                            <input type="hidden" name="uid" value="<?php echo $user['id'];?>">
                            <font class="text-green-800 font-bold">
                                Name:
                            </font>
                            <div class="flex gap-2 p-2"">
                                <input type="text" name="fname" value="<?php echo $user['fname'];?>" class="w-full border-2 border-gray-300 rounded-md p-1">
                                <input type="text" name="lname" value="<?php echo $user['lname'];?>" class="w-full border-2 border-gray-300 rounded-md p-1">
                            </div>
                            <font class="text-green-800 font-bold">
                                Email:
                            </font>
                            <div class="p-2">
                                <input type="text" name="email" value="<?php echo $user['email'];?>" class="w-full border-2 border-gray-300 rounded-md p-1">
                            </div>
                            <font class="text-green-800 font-bold">
                                Phone:
                            </font>
                            <div class="p-2">
                                <input type="phone" name="phone" value="<?php echo $user['phone'];?>" class="w-full border-2 border-gray-300 rounded-md p-1 w-[6.4rem]">
                            </div>
                            <font class="text-green-800 font-bold">
                                Date of Birth:
                            </font>
                            <div class="p-2">
                                <input type="date" name="dob" value="<?php echo $user['dob'];?>" class="w-full border-2 border-gray-300 rounded-md p-1 w-[6.4rem]">
                            </div>
                            <font class="text-green-800 font-bold">
                                Role:
                            </font>
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
                            <font class="text-green-800 font-bold">
                                Business Unit:
                            </font>
                            <div class="p-2">
                                <select name="entity" id="" class="w-full border-2 border-gray-300 rounded-md p-1">
                                <option value="">
                                    Select Unit
                                </option>
                                <?php 
                                    foreach($b_entities as $entity){
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
    <!-- edit modal ends here -->
        <?php
    }
    function noUnitModel(){
        ?>
        <!-- delete modal -->
        <div id="noUnitModal" data-modal-backdrop="static" tabindex="-1" class="fixed flex flex-col items-center justify-center bg-black/90 top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-red-700 border-4 border-green-900 rounded-lg shadow">
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-white w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-white ">
                            There is no Business unit assingned to you.<br>Contact your administrator!    
                        </h3>
                        <a href="../controllers/logout.php">
                            <button type="button" class="text-green-900 bg-gray-200 hover:bg-green-900 hover:border-gray-200 hover:text-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-2 border-green-900 text-sm font-medium px-5 py-2.5 focus:z-10">Ok</button>
                        </a>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    function selectUnitModel($units){
        ?>
        <!-- select business unit modal -->
        <div id="selectUnit" data-modal-backdrop="static" tabindex="-1" class="fixed flex flex-col items-center justify-center bg-black/90 top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative  w-full max-w-md max-h-full">
                <div class="relative bg-green-900 border-2 border-gray-200 rounded-lg shadow">
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-white w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-white ">Select a Business unit!</h3>
                        <form action="../controllers/set_unit.php" method="POST" class="inline-flex">
                            <select name="unit_id" id="" class="px-2 py-1 rounded-lg mr-2" required>
                                <option value="">select unit</option>
                                <?php
                                    foreach($units as $unit){
                                        ?>
                                        <option value="<?php echo $unit['id'];?>">
                                            <?php echo $unit['name'];?>
                                        </option>
                                        <?php
                                    }
                                ?>
                            </select>
                            
                            <button name="set_unit" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Go
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
?>