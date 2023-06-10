<?php
    include "queries.php";
    if(isset($_POST['add-creator'])){
        $fn = $_POST['fname'];
        $ln = $_POST['lname'];
        $el = $_POST['email'];
        $pd = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $pn = $_POST['phone'];
        $db = $_POST['dob'];
        $tp = 'C';
        $qry = "INSERT INTO users(fname, lname, email, password, phone, dob, type) VALUES('$fn','$ln','$el','$pd','$pn','$db','$tp')";
        addData($qry);
        $_SESSION['msg'] = "success";
    }
    else
        $_SESSION['msg'] = "no data";
    

?>