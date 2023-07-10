<?php 
  include 'includes/b_header.php'; 
  include "../controllers/models.php";
  include "../controllers/msg.php";
  $uid = $user_data['id'];
  $units = specialQuery("SELECT * FROM budgeting_entities WHERE incharge = '$uid'");  
  //var_dump(count($units));
  if(count($units) == 1){
    $sql_u = specialNoResult("SELECT * FROM budgeting_entities WHERE incharge = '$uid'");
    $units = mysqli_fetch_array($sql_u);
    $num = mysqli_num_rows($sql_u);
    $eid = $units['id'];
    $ename = $units['name'];
    echo "Business Unit: ".$ename;
    $item_ids = getNumItems($eid);
    $num_item_ids = count($item_ids);
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
    $item_ids = getNumItems($eid);
    $num_item_ids = count($item_ids);
    //unset($_SESSION['unit']);
  }
  function getNumItems($id){
    $i_sql = "SELECT item FROM entity_has_item WHERE entity = '$id'";
    $items = specialQuery($i_sql);
    return $items;
  }
  $periods = getData('budget_periods');
?>
  <!-- Dashboard Content -->
  <div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold mb-4">Budget Form</h2>
    <form action="../controllers/submit.php" method="POST" class="max-w-lg mx-auto overflow-x-auto">
      <div class="mb-4">
        <input type="hidden" name="user" value="<?php echo $uid;?>">
        <input type="hidden" name="entity" value="<?php echo $eid;?>">
        <label for="category" class="block text-gray-700 font-bold mb-2">Budgeting Period:</label>
        <select name="period" class="w-full border border-gray-300 rounded py-2 px-4 focus:outline-none focus:border-blue-500" required>
          <option value="">Select period</option>
          <?php
            foreach($periods as $period){
              $frm = date_create($period['_from']);
              $today = date_create(date("Y-m-d"));
              $days = date_diff($today, $frm)->format("%R%a");
              if($days >= 0){
                $f = date("d-m-Y", strtotime($period['_from']));
                $t = date("d-m-Y", strtotime($period['_to']));
                $n = str_replace(" ", "", $period['name']);
                ?>
                <option value="<?php echo $period['id']?>">
                  <?php echo $n." (From ".$f." to ".$t.")";?>
                </option>
                <?php
              }
            }
          ?>
        </select>
      </div>
      <div class="mb-4">
        <h3 class="text-xl font-bold mb-2">Items:</h3>
        <?php
          // echo "<br>No. of Items:".$num_item_ids;
          if($num_item_ids < 1){
            echo "<font class='text-red-400 font-bold'> No Budget items attached to ".$ename." yet!<br> Contact your administrator</font>";
          }
          else{
            // echo "<br>I'm in!<br>";
            // var_dump($item_ids);
            ?>
            <div id="budgetItemsContainer" class="space-y-4">
              <!-- Add more item input fields as needed -->
            </div>
            <?php
          }
        ?>
      </div>

      <div class="flex justify-end">
        <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="addBudgetItem()">Add item</button>
      </div>
      <div class="py-12 px-6 w-46">
        <button type="submit" name="add-budget" class="w-full bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Submit</button>
      </div>
    </form>
  </div>
  <script type="text/javascript">
    let rowCount = 0; // Counter for generating unique row IDs
    // Add initial row when the page loads
    window.addEventListener("DOMContentLoaded", function() {
      addBudgetItem();
    });
    function addBudgetItem() {
      const container = document.getElementById("budgetItemsContainer");
      const rowId = "row-" + rowCount;
      const row = document.createElement("div");
      row.id = rowId;
      row.className = "flex space-x-3";
      const selectInput = createSelect(rowId, {
        name: "item[]",
        class: "w-full border border-gray-300 rounded py-2 px-1 focus:outline-none focus:border-blue-500",
        required: true
      });
      // Add options to the select element
      const options = [
        { text: "Select Item", value: "" },
        <?php 
          foreach($item_ids as $item_id){
            $iid = $item_id['item'];
            $item = mysqli_fetch_array(specialNoResult("SELECT * FROM budget_items WHERE id = $iid"));
            $i_name = $item['name'];
            $i_unit = specialNoResult("SELECT unit from entity_has_item WHERE entity = '$eid' AND item = '$iid'")->fetch_column();
            ?>
            { text: "<?php echo $i_name.' ('.$i_unit.')'?>", value: "<?php echo $iid?>" },
            <?php
          }
        ?>
      ]; // Example options
      for (const optionData of options) {
        const option = document.createElement("option");
        option.text = optionData.text;
        option.value = optionData.value;
        selectInput.add(option);
      }
      const quantityInput = createInput("quantity", rowId, {
        type: "number",
        name: "quantity[]",
        class: "w-full border border-gray-300 rounded py-2 px-1 focus:outline-none focus:border-blue-500",
        placeholder: "Qnty",
        required: true
      });
      const priceInput = createInput("price", rowId, {
        type: "number",
        name: "price[]",
        class: "w-full border border-gray-300 rounded py-2 px-1 focus:outline-none focus:border-blue-500",
        placeholder: "Price",
        required: true
      });
      const totalInput = createInput("total", rowId, {
        type: "text",
        name: "total[]",
        class: "w-full border border-gray-300 rounded py-2 px-1 focus:outline-none focus:border-blue-500",
        placeholder: "Total",
        readonly: true
      });
      // Attach event listener to price input for auto-generating total
      priceInput.addEventListener("input", function() {
        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        totalInput.value = (quantity * price).toFixed(1);
      });
      const removeButton = createRemoveButton(rowId, {
        class: "bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded",
        "data-row-id": rowId
      });
      removeButton.addEventListener("click", function() {
        removeBudgetItem(rowId);
      });

      row.appendChild(selectInput);
      row.appendChild(quantityInput);
      row.appendChild(priceInput);
      row.appendChild(totalInput);
      row.appendChild(removeButton);
      container.appendChild(row);
      rowCount++;
    }
    function createSelect(rowId, attributes) {
      const select = document.createElement("select");
      select.id = "select-" + rowId;
      // Set additional attributes
      for (const attr in attributes) {
        select.setAttribute(attr, attributes[attr]);
      }
      return select;
    }
    // Rest of the code...
    function createInput(name, rowId, attributes) {
      const input = document.createElement("input");
      input.name = name;
      input.id = name + "-" + rowId;
      // Set additional attributes
      for (const attr in attributes) {
        input.setAttribute(attr, attributes[attr]);
      }
      return input;
    }
    function createRemoveButton(rowId, attributes) {
      const button = document.createElement("button");
      button.type = "button";
      button.textContent = "X";
      button.dataset.rowId = rowId;
      // Set additional attributes
      for (const attr in attributes) {
        button.setAttribute(attr, attributes[attr]);
      }
      return button;
    }
    function removeBudgetItem(rowId) {
      const row = document.getElementById(rowId);
      if (row) {
        row.remove();
      }
    }
  </script>
  <?php include 'includes/footer.php' ?>