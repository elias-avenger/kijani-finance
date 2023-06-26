<?php 
  include 'includes/header.php'; 
  include "../controllers/models.php";
  include "../controllers/msg.php";  
?>
  <!-- Category Addition Content -->
  <div class="container mx-auto py-8 px-4">
    <button data-modal-target="categoryModal" data-modal-toggle="categoryModal" class="bg-green-900 px-4 py-2 text-white rounded-lg">Add Category</button>
      <div class="hidden fixed z-50 bg-green-900 overflow-x-auto shadow-md rounded-md p-4  mb-2 text-white" id="categoryModal">
        <form id="" class="mx-auto flex " action="../controllers/submit.php" method="POST">
          <div class="mr-4">
            <label class="block text-gray-100 text-sm font-bold mb-2" for="cat-name">Category Name:</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 focus:shadow-outline" id="categoryName" name="cat-name" type="text" placeholder="Enter category name" required>
          </div>
          <div class="mr-4">
            <label class="block text-gray-100 text-sm font-bold mb-2" for="description">Description:</label>
            <textarea name="description" id="" cols="40" rows="3" class="border rounded w-full py-2 px-3 text-gray-700 focus:shadow-outline"></textarea>
          </div>
          <div class="flex items-center ml-4">
            <input type="submit" value="Add Category" name="add-category" class="bg-green-800 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:shadow-outline">
          </div>
        </form>
        <div class="absolute right-0 top-0 p-1">
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm ml-auto inline-flex items-start dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="categoryModal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </button>
        </div>
      </div>
    <button data-modal-target="itemModal" data-modal-toggle="itemModal" class="bg-green-900 px-4 py-2 text-white rounded-lg">Add Item</button> 
    <?php 
      $categories = getData('item_categories');
      $entities = getData('budgeting_entities');
      addItemModel($categories, $entities);
    ?>
    <h2 class="text-2xl font-bold mt-8 mb-4">Existing Categories</h2>
    <div class="flex flex-col md:flex-row gap-4 md:space-x-4">
      <div class="w-full md:w-1/3">
        <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
          <h3 class="text-xl font-bold mb-4">Categories</h3>
          <table class="">
            <thead>
              <tr class="text-center">
                <th class="py-2">Category Name</th>
                <th class="py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($categories as $category){
                  ?>
                  <tr>
                    <td class="p-2"><?php echo $category['name'];?></td>
                    <td class="p-2">
                    <td class="flex gap-4 p-2">
                      <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                      <!-- delete button -->
                        <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal">
                          <img src="../images/delete_black_24dp.svg" alt="delete">
                        </button>
                        <?php
                          $model = 'category';
                          deleteModel($model, $category['id']);
                        ?>
                    </td>
                    </td>
                  </tr>
                  <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class=" w-full md:w-1/3">
        <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
          <h3 class="text-xl font-bold mb-4">Items</h3>
          <table class="">
            <thead>
              <tr class="text-center">
                <th class="py-2">Item Name</th>
                <th class="py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="p-2">Item 1</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Item 2</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Item 3</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Item 4</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Item 5</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
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

  <?php include 'includes/footer.php' ?>