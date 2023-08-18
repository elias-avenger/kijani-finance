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
        <h1 class="font-bold pl-2">Departments</h1>
      </div>
    </div>

    <div class="flex flex-wrap p-6">
      <div class="relative bg-white shadow-md rounded-md p-4">
      <?php
          $users = getData('users');
          $b_users = specialQuery("SELECT id FROM users WHERE type = 'B'");
          if(!empty($b_users)){
            ?>
            <!-- add department button -->
            <button data-modal-toggle="departmentModal" class="bg-green-800 text-white mb-2 px-2 py-2 rounded-md hover:bg-green-600 m-2">
              Add Business Unit
            </button>
            <!-- Add department modal -->
            <?php 
              addDepartmentModel($users);
          }
          $entities = getData('budgeting_entities');
        ?>
      </div>
    </div>

    <div class="flex flex-row flex-wrap flex-grow mt-2">
          
      <div class="w-full md:w-2/3 pt-6 pb-6 md:p-6">
        <!--Table Card-->
        <div class="bg-white border-transparent rounded-lg shadow-xl">
          <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
            <h2 class="font-bold uppercase text-gray-600">Business Units</h2>
          </div>
          <div class="p-5 overflow-x-auto">

            <table class="">
              <thead>
                <tr class="text-center">
                  <th class="py-2">Unit Name</th>
                  <th class="py-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach($entities as $entity){
                    ?>
                    <tr>
                      <td class="p-2"><?php echo $entity['name'];?></td>
                      <td class="flex gap-4 p-2">
                        <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                        <!-- delete button -->
                        <?php $model = 'unit';?>
                        <button type="button" data-modal-target="delete<?php echo $model;?>Modal<?php echo $entity['id'];?>" data-modal-toggle="delete<?php echo $model;?>Modal<?php echo $entity['id'];?>">
                          <img src="../images/delete_black_24dp.svg" alt="delete">
                        </button>
                        <?php
                          deleteModel($model, $entity['id']);
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
        <!--Table card-->
      </div>
      
    </div>

  </div>
</section>
<?php include 'includes/footer.php' ?>
