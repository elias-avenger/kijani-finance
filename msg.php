<?php
  if(isset($_SESSION['msg'])){
    $type = $_SESSION['msg'];
    if($type == "success"){
        $clr = 'green-700';
        $msg = 'Successfuly done!';
    }
    elseif($type == "login-f"){
        $clr = 'red-700';
        $msg = 'Username or Password Incorrect!';
    }
    elseif($type == "conf-pass"){
      $clr = 'red-700';
      $msg = "Passwords don't match!";
    }
    elseif($type == "phone-fmt"){
      $clr = 'red-700';
      $msg = "Wrong Phone Number Format!";
    }
    elseif($type == "user-f"){
      $clr = 'red-700';
      $msg = "Email or Password Incorrect!";
    }
    elseif($type == "pswd-f"){
      $clr = 'red-700';
      $msg = "Email or Password Incorrect!";
    }
    ?>
    <div id="msg-box" class="mb-4 bg-white text-<?php echo $clr;?> font-bold">
        <?php echo $msg;?>
    </div>
    <script src="msg.js"></script>
    <?php
    unset($_SESSION['msg']);
  }
?>