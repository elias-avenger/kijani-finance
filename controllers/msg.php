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
      $msg = "Email or Password Incorrect! Please try again";
    }
    elseif($type == "pswd-f"){
      $clr = 'red-700';
      $msg = "Email or Password Incorrect!";
    }
    elseif($type == "email-exists"){
      $clr = 'red-700';
      $msg = "User account with the same <u>email</u> already exists!";
    }
    elseif($type == "deleted"){
      $clr = 'green-700';
      $msg = "Deleted successfuly!";
    }
    elseif($type == "updated"){
      $clr = 'green-700';
      $msg = "Updated successfuly!";
    }
    elseif($type == "delete_f"){
      $clr = 'red-700';
      $msg = "Can't Delete: What you want to delete should be referenced ...!";
    }
    elseif($type == "period-h"){
      $clr = 'red-700';
      $msg = "Period bigger than chosen period type. <br>Try Again!";
    }
    elseif($type == "period-l"){
      $clr = 'red-700';
      $msg = "Period smaller than chosen period type. <br>Try Again!";
    }
    elseif($type == "period-o"){
      $clr = 'red-700';
      $msg = "Period overlap detected. <br>Try Again!";
    }
    else{
      $clr = 'red-700';
      $msg = "Error!<br>No message set.";
    }
    ?>
    <div class="flex flex-col items-center">
      <div id="msg-box" class="m-x-auto flex p-4 mt-4 mb-4 text-white border-2 border-t-4 rounded-lg border-<?php echo $clr;?> bg-<?php echo $clr;?>" role="alert">
        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div class="ml-3 text-sm font-medium">
          <?php echo $msg;?>
        </div>
      </div>
    </div>
    <script src="../msg.js"></script>
    <?php
    unset($_SESSION['msg']);
  }
?>