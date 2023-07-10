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
        $c = $_POST['category'];
        $entities = $_POST['entity'];
        $units = $_POST['unit'];
        $justifications = $_POST['justification'];
        var_dump($entities);
        
        $qry = "INSERT INTO budget_items SET name= '$n', description = '$d', category = '$c'";
        addData($qry);
        $i_qry = "SELECT id FROM budget_items WHERE id IN(SELECT MAX(id) FROM budget_items)";
        $item = mysqli_fetch_array(specialNoResult($i_qry));
        $i_id = $item['id'];
        foreach($entities as $e){
            $i = array_search($e, $entities);
            $u = $units[$i];
            $j = $justifications[$i];
            $q = "INSERT INTO entity_has_item SET entity = '$e', item = '$i_id', unit = '$u', justification = '$j'";
            addData($q);
        }
        $_SESSION['msg'] = "success";
        header("location: ../dashboard/dash_items.php");
    }
    if(isset($_POST['add-bperiod'])){
        $p_t = $_POST['p-type'];
        $p_from = $_POST['p-from'];
        $p_to = $_POST['p-to'];
        $pf = date_create($p_from);
        $pt = date_create($p_to);
        $days = date_diff($pf, $pt)->format("%R%a");
        $max_date = date_create(selectMAx('budget_periods', '_to'));
        $diff_prev = (int)date_diff($max_date, $pf)->format("%R%a");
        $periods = getData('budget_periods');
        if(($p_t === 'W' & $days > 7) | ($p_t === 'F' & $days > 14))
        {
            $_SESSION['msg'] = "period-h";
            header("location: ../dashboard/dash_budgets.php");
        }
        elseif(($p_t === 'W' & $days < 4) | ($p_t === 'F' & $days < 8))
        {
            $_SESSION['msg'] = "period-l";
            header("location: ../dashboard/dash_budgets.php");
        }
        elseif($diff_prev <= 0 && !empty($periods)){
            echo "<br> Date overlap detected!";
            $_SESSION['msg'] = "period-o";
            header("location: ../dashboard/dash_budgets.php");
        }
        else{
            $n = $p_t==='W'?"Week":"Fortnight";
            $num = selectCountWhere('budget_periods', 'type', $p_t);
            $name = $n."-".$num + 1;
            $qry = "INSERT INTO budget_periods set name = '$name', _from = '$p_from', _to = '$p_to', type = '$p_t'";
            addData($qry);
            $_SESSION['msg'] = "success";
            header("location: ../dashboard/dash_budgets.php");
        }
        
    }
    if(isset($_POST['add-budget'])){
        $s_by = $_POST['user'];
        $entity = $_POST['entity'];
        $period = $_POST['period'];
        $items = $_POST['item'];
        $qntys = $_POST['quantity'];
        $prices = $_POST['price'];
        $b_no = "B-E-".$entity."-P-".$period;
        $incharge = specialNoResult("SELECT incharge FROM budgeting_entities WHERE id = '$entity'")->fetch_column();
        //$i = $incharge['incharge'];
        var_dump($b_no);
        foreach($items as $item){
            $x = array_search($item, $items);
            $q = $qntys[$x];
            $c = $prices[$x];
            $b_qry = "INSERT INTO budgets SET quantity = '$q', cost = '$c', budget_no = '$b_no', incharge='$incharge', submitted_by = '$s_by', entity = '$entity', item = '$item', period = '$period'";
            addData($b_qry);
        }
        $_SESSION['msg'] = "success";
        header("location: ../dashboard/budgeting.php");
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