<?php
    include "queries.php";
    $users = getData('users');
    if(empty($users)){
        header("location:admin_signup.php");
    }
    echo "Login here!"
?>