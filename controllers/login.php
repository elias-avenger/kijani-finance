<?php
    include "db/queries.php";
    $em = $_POST['email'];
    $pd = $_POST['password'];
    $user_data = getUser($em);
    if(mysqli_num_rows($user_data) === 1){
        $user_array = mysqli_fetch_array($user_data);
        //var_dump($user_array['password']);
        if(password_verify($pd, $user_array['password']))
        {
            $_SESSION['email'] = $em;
            $type = $user_array['type'];
            if($type === 'A'){
                header("location: ../dashboard/dashboard.php");
            }
            elseif($type === 'B')
            {
                header("location: budgeting.php");
            }
        }
        else{
            $_SESSION['msg'] = 'pswd-f';
            header("location: ../index.php");
        }
    }
    else{
        $_SESSION['msg'] = 'user-f';
        header("location: ../index.php");
    }
    
?>