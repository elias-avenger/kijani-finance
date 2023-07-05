<?php 
  include 'includes/header.php'; 
  include "../controllers/models.php";
  include "../controllers/msg.php";  
?>
  <!-- Category Addition Content -->
  <div class="container mx-auto py-8 px-4">
    <button data-modal-target="categoryModal" data-modal-toggle="categoryModal" class="bg-green-900 px-4 py-2 text-white rounded-lg">Add Item Category</button>
      <?php addCategoryModel();?>
    <button data-modal-target="itemModal" data-modal-toggle="itemModal" class="bg-green-900 px-4 py-2 text-white rounded-lg">Add Item</button> 
    <?php 
      $categories = getData('item_categories');
      $entities = getData('budgeting_entities');
      $items = getData('budget_items');
      addItemModel($categories, $entities);
    ?>
    <!-- existing items table -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Items and Categories</h2>
    <div class="flex flex-col md:flex-row gap-4 md:space-x-4">
      <div class="w-full md:w-1/3">
        <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
          <h3 class="text-xl font-bold mb-4">Item Categories</h3>
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
                    <td class="flex gap-4 p-2">
                      <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                      <!-- delete button -->
                      <?php $model = 'category';?>
                      <button type="button" data-modal-target="delete<?php echo $model;?>Modal" data-modal-toggle="delete<?php echo $model;?>Modal">
                        <img src="../images/delete_black_24dp.svg" alt="delete">
                      </button>
                      <?php
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
      <div class="w-full md:w-1/3">
        <div class="bg-white overflow-x-auto shadow-md rounded-md p-4">
          <h3 class="text-xl font-bold mb-4">Items</h3>
          <table class="">
            <thead>
              <tr class="text-center">
                <th class="py-2">Item Name</th>
                <th class="py-2">Business Units</th>
                <th class="py-2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($items as $item){
                  $iid = $item['id'];
                  $e_qry = "SELECT name FROM budgeting_entities WHERE id IN(SELECT entity FROM entity_has_item WHERE item = '$iid')";
                  $etys = specialQuery($e_qry);
                  $ents = [];
                  foreach($etys as $ety) array_push($ents, $ety['name']);
                  ?>
                  <tr>
                    <td class="p-2"><?php echo $item['name'];?></td>
                    <td class="p-2"><?php echo implode(", ", $ents);?></td>
                    <td class="flex gap-4 p-2">
                      <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $iid;?>"></a>
                      <!-- delete button -->
                      <?php $model = 'item';?>
                      <button type="button" data-modal-target="delete<?php echo $model;?>Modal" data-modal-toggle="delete<?php echo $model;?>Modal">
                        <img src="../images/delete_black_24dp.svg" alt="delete">
                      </button>
                      <?php
                        deleteModel($model, $iid);
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
    </div>
  </div>

  <?php include 'includes/footer.php' ?>