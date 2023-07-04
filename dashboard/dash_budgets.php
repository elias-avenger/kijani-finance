<?php 
  include 'includes/header.php';
  include "../controllers/models.php";
  include "../controllers/msg.php";
?>
 <!-- Budgets Content -->
 <div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold mb-4">Budgets</h2>

    <!-- Budget Control Panel -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Budget Table -->
      <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
        <table class="w-full ">
          <thead>
            <tr>
              <th class="py-2">User Name</th>
              <th class="py-2">Category</th>
              <th class="py-2">Submitted</th>
              <th class="py-2">Week</th>
              <th class="py-2">Amount</th>
              <th class="py-2">Approval Status</th>
              <th class="py-2">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Budget Row 1 -->
            <tr>
              <td class="p-2">Elias Muhoozi</td>
              <td class="p-2">Category 1</td>
              <td class="p-2">12/12/2000</td>
              <td class="p-2">Week 14</td>
              <td class="p-2">$1000</td>
              <td class="p-2">
                <span class="bg-red-500 text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Not Approved</span>
              </td>
              <td class="flex gap-4 p-2">
                <a href="#" data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" type="button"><img src="visibility_black_24dp.svg" alt="view"></a>
                <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-green-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                  View budget
                  <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
              </td>
            </tr>
            <!-- Budget Row 2 -->
            <tr>
              <td class="p-2">Elias Muhoozi</td>
              <td class="p-2">Category 1</td>
              <td class="p-2">12/12/2000</td>
              <td class="p-2">Week 14</td>
              <td class="p-2">$1000</td>
              <td class="p-2">
                <span class="bg-green-900 text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Approved</span>
              </td>
              <td class="flex gap-4 p-2">
                <a href="#"><img src="visibility_black_24dp.svg" alt="edit"></a>
              </td>
            </tr>
            <!-- Budget Row 3 -->
            <tr>
              <td class="p-2">Elias Muhoozi</td>
              <td class="p-2">Category 1</td>
              <td class="p-2">12/12/2000</td>
              <td class="p-2">Week 14</td>
              <td class="p-2">$1000</td>
              <td class="p-2">
                <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Not Approved</span>
              </td>
              <td class="flex gap-4 p-2">
                <a href="#"><img src="visibility_black_24dp.svg" alt="edit"></a>
              </td>
            </tr>
            <!-- Add Budget Row -->
          </tbody>
        </table>
      </div>
    </div>
    <div class="relative bg-white shadow-md rounded-md p-4">
      <!-- Addd new budgeting period button -->
      <button data-modal-toggle="bPeriodModal" class="bg-green-800 text-white mb-2 px-1 py-2 rounded-md hover:bg-green-600 w-full">
        Add a new Budgeting Period
      </button>
      <!-- Add budgeting period model -->
      <?php
        addBPeriodModel();
      ?>
    </div>
  </div>
<?php 
  include 'includes/footer.php';
?>