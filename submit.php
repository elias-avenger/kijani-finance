<?php
    include "queries.php";
    if(isset($_POST['add-creator'])){
        $fn = $_POST['fname'];
        $ln = $_POST['lname'];
        $el = $_POST['email'];
        $pd = $_POST['password'];
        $pn = $_POST['phone'];
        $db = $_POST['dob'];
        $tp = 'A';
        $cp = $_POST['conf_password'];
        if(!preg_match('/^[0-9]{10}+$/', $pn)){
            $_SESSION['msg'] = "phone-fmt";
        }
        elseif($pd !== $cp){
            $_SESSION['msg'] = "conf-pass";
        }
        else{
            $pwd = password_hash($pd, PASSWORD_DEFAULT);
            $qry = "INSERT INTO users(fname, lname, email, password, phone, dob, type) VALUES('$fn','$ln','$el','$pwd','$pn','$db','$tp')";
            addData($qry);
            $_SESSION['msg'] = "success";
        }
        header("location: admin_signup.php");
    }
?>