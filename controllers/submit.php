<?php
    include "db/queries.php";
    
    if(isset($_POST['add-creator'])){
        $type = 'A';
        validateAndSubmitUser($type);
        header("location: ../admin_signup.php");
    }
    if(isset($_POST['add-user'])){
        $type =  $_POST['role'];
        validateAndSubmitUser($type); 
        header("location: ../dashboard/dash_users.php");   
    }

    if(isset($_POST['add-entity'])){
        $n = $_POST['e-name'];
        $d = $_POST['e-description'];
        $i = $_POST['incharge'];
        $qry = "INSERT INTO budgeting_entities SET name = '$n', description = '$d', incharge = '$i'";
        addData($qry);
        $_SESSION['msg'] = "success";
        header("location: ../dashboard/dash_users.php");
    }
    if(isset($_POST['add-category'])){
        $n = $_POST['cat-name'];
        $d = $_POST['description'];
        $qry = "INSERT INTO item_categories SET name= '$n', description = '$d'";
        addData($qry);
        $_SESSION['msg'] = "success";
        header("location: ../dashboard/dash_items.php");
    }
    if(isset($_POST['add-item'])){
        $n = $_POST['i-name'];
        $d = $_POST['description'];
        $u = $_POST['unit'];
        $c = $_POST['category'];
        $entities = $_POST['entity'];
        var_dump($entities);
        
        $qry = "INSERT INTO budget_items SET name= '$n', description = '$d', unit = '$u', category = '$c'";
        addData($qry);
        $i_qry = "SELECT id FROM budget_items WHERE id IN(SELECT MAX(id) FROM budget_items)";
        $item = mysqli_fetch_array(specialNoResult($i_qry));
        $i_id = $item['id'];
        foreach($entities as $e){
            $q = "INSERT INTO entity_has_item SET entity = '$e', item = '$i_id'";
            addData($q);
        }
        $_SESSION['msg'] = "success";
        header("location: ../dashboard/dash_items.php");
    }

    function validateAndSubmitUser($tp){
        $fn = $_POST['fname'];
        $ln = $_POST['lname'];
        $el = $_POST['email'];
        $pd = $_POST['password'];
        $pn = $_POST['phone'];
        $db = $_POST['dob'];
        $cp = $_POST['conf_password'];
        if(isset($_SESSION['email'])){
            $user_data = mysqli_fetch_array(getUser($_SESSION['email']));
            $uid = $user_data['id'];
        }
        if(mysqli_num_rows(getUser($el)) >= 1){
            $_SESSION['msg'] = "email-exists";
        }
        elseif(!preg_match('/^[0-9]{10}+$/', $pn)){
            $_SESSION['msg'] = "phone-fmt";
        }
        elseif($pd !== $cp){
            $_SESSION['msg'] = "conf-pass";
        }
        else{
            $pwd = password_hash($pd, PASSWORD_DEFAULT);
            $qry = "INSERT INTO users(fname, lname, email, password, phone, dob, type, registered_by) VALUES('$fn','$ln','$el','$pwd','$pn','$db','$tp','$uid')";
            addData($qry);
            $_SESSION['msg'] = "success";
        }
    }
?>