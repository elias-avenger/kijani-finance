<?php
    include "db/queries.php";
    if(isset($_POST['update-user'])){
        $id = $_POST['uid'];
        $full_name = explode(" ", $_POST['full-name']);
        $fn = $full_name[0];
        $ln = $full_name[1];
        $el = $_POST['email'];
        $pn = $_POST['phone'];
        $tp = $_POST['type'];
        $dt = $_POST['entity'];
        $uqry = "UPDATE users SET fname = '$fn', lname='$ln', email='$el', phone='$pn', type='$tp' WHERE id='$id'";
        update($uqry);
        if($dt != ''){
        $eqry = "UPDATE budgeting_entity SET incharge='$id' WHERE id='$dt'";
        update($eqry);
        }
        header("location: ../dashboard/dash_users.php");
    }
?>