<?php
    function deleteModel($model_name, $id){
        ?>
        <!-- delete modal -->
        <div id="deleteModal" tabindex="-1" class="hidden fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-green-900 rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-white bg-transparent hover:bg-white hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-white w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-white ">Are you sure you want to delete this <?php echo $model_name;?>?</h3>
                        <form action="../controllers/delete.php" method="POST" class="inline-flex">
                            <input type="hidden" value="<?php echo $id;?>" name="id">
                            <button name="delete_<?php echo $model_name;?>" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-hide="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    function addItemModel($categories, $entities){
        ?>
        <div class="hidden fixed z-50 bg-green-900 overflow-x-auto shadow-md rounded-md p-4" id="itemModal">
            <form class="mx-auto flex " action="../controllers/submit.php" method="POST">
                <div class="mr-4">
                    <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="i-name" name="i-name" type="text" placeholder="Enter Item name" required>
                </div>
                <div class="mr-4">
                    <textarea name="description" id="" cols="40" rows="3" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter item Description"></textarea>
                </div>
                <div class="mr-4">
                    <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="unit" name="unit" type="text" placeholder="Units" required>
                </div>
                <div class="mr-4">
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
                <div class="mr-4" style="display: flex; flex-direction:column; color:white">
                    <label class="text-xl">Select where it applies:</label>
                    <?php
                    foreach($entities as $entity){
                        ?>
                        <div>
                            <input type="checkbox" value="<?php echo $entity['id'];?>" name="entity[]"> <?php echo $entity['name'];?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="flex items-center ml-4">
                    <input type="submit" value="Add Item" name="add-item" class="bg-green-800 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:shadow-outline">
                </div>
            </form>
            <div class="absolute right-0 top-0">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto inline-flex items-start dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="itemModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            </div>
        <?php
    }
?>