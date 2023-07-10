<?php 
  include 'includes/header.php';
  include "../controllers/models.php";
  include "../controllers/msg.php";
?>
<!-- Budgets Content -->
<div class="container mx-auto py-8">
  <h2 class="text-3xl font-bold mb-4">Budgets</h2>
    <div class="relative bg-white shadow-md rounded-md p-4">
      <!-- Addd new budgeting period button -->
      <button data-modal-toggle="bPeriodModal" class="bg-green-800 text-white mb-2 px-1 py-2 rounded-md hover:bg-green-600">
        Add a new Budgeting Period
      </button>
      <!-- Add budgeting period model -->
      <?php
        addBPeriodModel();
        $units = getData('budgeting_entities');
      ?>
    </div>
  <!-- Budget Control Panel -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
      <!-- Budget Table -->
      <table class="w-full ">
        <thead>
          <tr>
            <th class="py-2">Submited By</th>
            <th class="py-2">Business Unit</th>
            <th class="py-2">Submitted On</th>
            <th class="py-2">Budget Period</th>
            <th class="py-2">Amount</th>
            <th class="py-2">Approval Status</th>
            <th class="py-2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($b_units as $b_unit){
              $unit_id = $b_unit['id'];
              $unit_name = $b_unit['name'];
              
              $budgets = specialQuery("SELECT * FROM budgets WHERE entity = '$unit_id'");
              if(count($budgets) >= 1){
                $cost = 0.0;
                $status_array = [];
                foreach($budgets as $budget){
                  $s_by = $budget['submitted_by'];
                  $array_s_by = mysqli_fetch_array(specialNoResult("SELECT fname, lname FROM users WHERE id = '$s_by'"));
                  $name_s_by = $array_s_by['fname']." ".$array_s_by['lname'];
                  // $entity = $budget['entity'];
                  // $entity_name = specialNoResult("SELECT name FROM budgeting_entities WHERE id = '$entity'")->fetch_column();
                  $submitted = date("d-m-Y", strtotime($budget['submitted_on']));
                  $p = $budget['period'];
                  $array_period = mysqli_fetch_array(specialNoResult("SELECT name, _from, _to FROM budget_periods WHERE id = '$p'"));
                  $period_name = $array_period['name']." (".$array_period['_from']." to ".$array_period['_to'].")";
                  $cost += $budget['cost'];
                  array_push($status_array, $budget['status']);
                }
                if(in_array('N', $status_array) && !in_array('A', $status_array))
                  $status = "Not Apporved";
                elseif(in_array('N', $status_array) && in_array('A', $status_array))
                  $status = "In Progress";
                elseif(!in_array('N', $status_array) && in_array('A', $status_array))
                  $status = "Approved";
                ?>
                <tr>
                  <td class="p-2"><?php echo $name_s_by;?></td>
                  <td class="p-2"><?php echo $unit_name;?></td>
                  <td class="p-2"><?php echo $submitted;?></td>
                  <td class="p-2"><?php echo $period_name;?></td>
                  <td class="p-2"><?php echo $cost;?></td>
                  <td class="p-2">
                    <span class="bg-red-500 text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"><?php echo $status;?></span>
                  </td>
                  <td class="flex gap-4 p-2">
                    <a href="#" data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" type="button"><img src="visibility_black_24dp.svg" alt="view"></a>
                    <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-green-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                      View budget
                      <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                  </td>
                </tr>
                <?php
              }
            } 
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php 
  include 'includes/footer.php';
?>