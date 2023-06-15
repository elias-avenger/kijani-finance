<?php include 'includes/header.php' ?>
  <!-- Category Addition Content -->
  <div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold mb-4">Add Category</h2>

    <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
      <form id="categoryForm" class="max-w-lg mx-auto" action="submit_category.php" method="POST">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryName">Category Name:</label>
          <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="categoryName" name="categoryName" type="text" placeholder="Enter category name" required>
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Add Category
          </button>
        </div>
      </form>
    </div>

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
              <tr>
                <td class="p-2">Category 1</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Category 2</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Category 3</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Category 4</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="p-2">Category 5</td>
                <td class="p-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</button>
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                </td>
              </tr>
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