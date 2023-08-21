<?php 
  include 'includes/header.php';
  include "../controllers/models.php";
  include "../controllers/msg.php";           
?>
<!-- Container -->
<section class="w-full">
  <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

    <div class="bg-gradient-to-b from-green-900 to-green-400 pt-3">
      <div class="rounded-tl-3xl bg-gradient-to-r from-green-900 to-green-400 p-4 shadow text-2xl text-white">
        <h1 class="font-bold pl-2">Budgets</h1>
      </div>
    </div>

    <div class="flex flex-wrap p-6">
      <div class="relative bg-white shadow-md rounded-md p-4">
        <button data-modal-toggle="bPeriodModal" class="bg-green-800 text-white mb-2 px-2 py-2 rounded-md hover:bg-green-600 m-2">
            Add a new Budgeting Period
        </button>
        <!-- Add budgeting period model -->
        <?php
          addBPeriodModel();
          $b_units = getData('budgeting_entities');
          //$b_nos = specialQuery("SELECT DISTINCT budget_no FROM budgets ORDER BY submitted_on DESC LIMIT 20");
          $b_periods = specialQuery("SELECT * FROM budget_periods WHERE _from - CURRENT_DATE < 7 ORDER BY _from DESC LIMIT 5; ");
        ?>
      </div>
    </div>

    <div class="flex flex-row flex-wrap flex-grow mt-2">
          
      <div class="w-full md:w-2/3 pt-6 pb-6 md:p-6">
        <!--Table Card-->
        <div class="bg-white border-transparent rounded-lg shadow-xl">
          <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
            <h2 class="font-bold uppercase text-gray-600">Registered Users</h2>
          </div>
          <div class="p-5 overflow-x-auto">
            <table class="">
              <thead>
                <tr>
                <th class="p-2">Submited By</th>
                  <th class="p-2">Business Unit</th>
                  <th class="p-2">Submitted On</th>
                  <th class="p-2">Budget Period</th>
                  <th class="p-2">Amount</th>
                  <th class="p-2">Approval Status</th>
                  <th class="p-2">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                  foreach($b_periods as $b_period){
                    $p_id = $b_period['id'];
                    $period_name = $b_period['name']." ( from ".$b_period['_from']." to ".$b_period['_to'].")";
                    foreach($b_units as $b_unit){
                      $unit_id = $b_unit['id'];
                      $unit_name = $b_unit['name'];
                      $budgets = specialQuery("SELECT * FROM budgets WHERE entity = '$unit_id' AND period = '$p_id'");
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
                          // $p = $budget['period'];
                          // $array_period = mysqli_fetch_array(specialNoResult("SELECT name, _from, _to FROM budget_periods WHERE id = '$p'"));
                          // $period_name = $array_period['name']." (".$array_period['_from']." to ".$array_period['_to'].")";
                          $cost += $budget['cost'] * $budget['quantity'];
                          array_push($status_array, $budget['status']);
                        }
                        if(in_array('N', $status_array) && !in_array('A', $status_array))
                          $status = "Not Apporved";
                        elseif(in_array('N', $status_array) && in_array('A', $status_array))
                          $status = "In Progress";
                        elseif(!in_array('N', $status_array) && in_array('A', $status_array))
                          $status = "Approved";
                        ?>
                        <tr class="">
                          <td class="p-2"><?php echo $name_s_by;?></td>
                          <td class="p-2"><?php echo $unit_name;?></td>
                          <td class="p-2"><?php echo $submitted;?></td>
                          <td class="p-2"><?php echo $period_name;?></td>
                          <td class="p-2"><?php echo $cost;?></td>
                          <td class="p-2">
                            <span class="bg-red-500 text-white text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                <?php echo $status;?>
                            </span>
                          </td>
                          <td class="flex gap-4">
                            <a href="#" data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" type="button"><img src="visibility_black_24dp.svg" alt="view"></a>
                            <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block py-2 text-sm font-medium text-white bg-green-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                              View budget
                              <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                          </td>
                        </tr>
                        <?php
                      }
                      // else{
                      //   echo "<br>No budget submitted for ".$unit_name." for ".$period_name;
                      // }
                    } 
                  } 
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!--/table Card-->
      </div>

    </div>
  </div>
</section>
<?php include 'includes/footer.php' ?>