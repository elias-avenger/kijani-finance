<?php
  if(isset($_SESSION['msg'])){
    ?>
    <div id="msg-box" style="height: 150px; width: 150px; background-color: salmon">
        <?php echo $_SESSION['msg'];?>
    </div>
    <script src="msg.js"></script>
    <?php
    unset($_SESSION['msg']);
  }
?>