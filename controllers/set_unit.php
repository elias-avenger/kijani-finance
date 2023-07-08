<?php
  session_start();
  if(isset($_POST['set_unit'])){
    if(isset($_SESSION['unit']))
      unset($_SESSION['unit']);
    $_SESSION['unit'] = $_POST['unit_id'];
    header("location:../dashboard/budgeting.php");
  }
?>