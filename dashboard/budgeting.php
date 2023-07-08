<?php 
  include 'includes/b_header.php'; 
  include "../controllers/models.php";
  include "../controllers/msg.php";
  $uid = $user_data['id'];
  $units = specialQuery("SELECT * FROM budgeting_entities WHERE incharge = '$uid'");  
  var_dump(count($units));
  if(count($units) == 1){
    $sql_u = specialNoResult("SELECT * FROM budgeting_entities WHERE incharge = '$uid'");
    $units = mysqli_fetch_array($sql_u);
    $num = mysqli_num_rows($sql_u);
    $eid = $units['id'];
    $ename = $units['name'];
    echo "Business Unit: ".$ename;
  }
  elseif(!isset($_SESSION['unit']) && count($units) > 1)
  {
    selectUnitModel($units);
  } 
  elseif(count($units) < 1){
    noUnitModel();
  }
  
  if(isset($_SESSION['unit'])){
    $eid = $_SESSION['unit'];
    foreach($units as $unit){
      if($unit['id'] === $eid)
        $ename = $unit['name'];
    }
    echo "Business Unit: ".$ename;
  }
?>
  <!-- Dashboard Content -->
  <div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold mb-4">Budget Form</h2>
    <form id="budgetForm" class="max-w-lg mx-auto overflow-x-auto">
      <div class="mb-4">
        <label for="category" class="block text-gray-700 font-bold mb-2">Budgeting Period:</label>
        <select id="category" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500">
          <option value="category1">Week 1</option>
          <option value="category2">Week 2</option>
          <option value="category3">Week 3</option>
          <!-- Add more category options as needed -->
        </select>
      </div>
      <div class="mb-4">
        <h3 class="text-xl font-bold mb-2">Items:</h3>
        <div id="items" class="space-y-4">
          <div class="flex space-x-4">
            <select id="category" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500">
              <option value="category1">Item</option>
              <option value="category2">fuel</option>
              <option value="category3">books</option>
              <!-- Add more category options as needed -->
            </select>
            <input type="number" min="1" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" placeholder="Quantity">
            <label for="" class="pt-2">Kg</label>
            <input type="number" min="0" step="0.01" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" placeholder="Price">
            <input type="text" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" value="10000" placeholder="" disabled>
            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Remove</button>
          </div>
          <!-- Add more item input fields as needed -->
        </div>
      </div>

      <div class="flex justify-end">
        <button id="addItemBtn" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add item</button>
      </div>
      <div class="py-12 px-6 w-46">
        <button type="submit" class="w-full bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const addItemBtn = document.getElementById('addItemBtn');
      const budgetItems = document.getElementById('items');

      addItemBtn.addEventListener('click', function () {
        const itemTemplate = `
        <div class="flex space-x-4">
            <select id="category" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500">
              <option value="category1">Item</option>
              <option value="category2">fuel</option>
              <option value="category3">books</option>
              <!-- Add more category options as needed -->
            </select>
            <input type="number" min="1" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" placeholder="Quantity">
            <label for="" class="pt-2">Kg</label>
            <input type="number" min="0" step="0.01" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" placeholder="Price">
            <input type="text" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" value="10000" placeholder="" disabled>
            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded">Remove</button>
          </div>
        `;

        const newItem = document.createElement('div');
        newItem.innerHTML = itemTemplate;
        budgetItems.appendChild(newItem);
      });

      budgetItems.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') {
          event.target.closest('.flex').remove();
        }
      });
    });
  </script>

  <?php include 'includes/footer.php' ?>