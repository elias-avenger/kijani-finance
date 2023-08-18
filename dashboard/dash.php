<?php 
    include "includes/header.php"; 
    include "../controllers/models.php";
    include "../controllers/msg.php";
?>

<section class="w-full">
    <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

        <div class="bg-gradient-to-b from-green-900 to-green-400 pt-3">
            <div class="rounded-tl-3xl bg-gradient-to-r from-green-900 to-green-400 p-4 shadow text-2xl text-white">
                <h1 class="font-bold pl-2">Dashboard</h1>
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="relative bg-white shadow-md rounded-md p-4">
                <button data-modal-toggle="add-user-form" class="bg-green-800 text-white mb-2 px-2 py-2 rounded-md hover:bg-green-600 m-2">
                    Add Item Category
                </button>
                <?php 
                addCategoryModel();
                $categories = getData('item_categories');
                $entities = getData('budgeting_entities');
                if(!empty($categories) && !empty($entities)){
                    ?>
                    <button data-modal-toggle="add-user-form" class="bg-green-800 text-white mb-2 px-2 py-2 rounded-md hover:bg-green-600 m-2">
                        Add Item
                    </button> 
                    <?php 
                }
                $items = getData('budget_items');
                addItemModel($categories, $entities);
                ?>
            </div>
        </div>

        <div class="flex flex-row flex-wrap flex-grow mt-2">
            
            <div class="w-full md:w-2/3 pt-6 pb-6">
                <!--Table Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h2 class="font-bold uppercase text-gray-600">Item Categories</h2>
                    </div>
                    <div class="p-5 overflow-x-auto">
                        <?php
                            if(empty($categories)){
                                echo "<font class='text-red-400 font-bold'> No categories registered yet!</font>";
                            }
                            else{
                                ?>
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
                                                <td class="p-2">
                                                    <?php echo $category['name'];?>
                                                </td>
                                                <td class="flex gap-4 p-2">
                                                    <a href="#"><img src="../images/edit_black_24dp.svg" alt="edit" id="pencil<?php echo $uid;?>"></a>
                                                    <!-- delete button -->
                                                    <?php $model = 'category';?>
                                                    <button type="button" data-modal-target="delete<?php echo $model;?>Modal<?php echo $category['id'];?>" data-modal-toggle="delete<?php echo $model;?>Modal<?php echo $category['id'];?>">
                                                    <img src="../images/delete_black_24dp.svg" alt="delete">
                                                    </button>
                                                    <?php
                                                    deleteModel($model, $category['id']);
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <!--/table Card-->
            </div>
            <div class="w-full md:w-2/3 pt-6 pb-6">
                <!--Table Card-->
                <div class="bg-white border-transparent rounded-lg shadow-xl">
                    <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                        <h2 class="font-bold uppercase text-gray-600">Items</h2>
                    </div>
                    <div class="p-5 text-center">
                    <?php
                        if(empty($items)){
                            echo "<font class='text-red-400 font-bold'> No items registered yet!</font>";
                        }
                        else{
                            ?>
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
                                        <button type="button" data-modal-target="delete<?php echo $model;?>Modal<?php echo $iid;?>" data-modal-toggle="delete<?php echo $model;?>Modal<?php echo $iid;?>">
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
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <!--/Table Card-->
            </div>


        </div>
    </div>
</section>

<?php include 'includes/footer.php' ?>