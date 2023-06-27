<?php
    include "db/queries.php";
    if(isset($_POST['delete_user'])){
        $t = 'users';
        $p = 'dash_users';
        $r = 'budgeting_entities';
        $fk = 'incharge';
        runDelete($t, $p, $r, $fk);
        
    }
    if(isset($_POST['delete_entity'])){
        $t = 'budgeting_entities';
        $p = 'dash_users';
        $r = 'entity_has_item';
        $fk = 'entity';
        runDelete($t, $p, $r, $fk);
    }
        
    if(isset($_POST['delete_category'])){
        $t = 'item_categories';
        $p = 'dash_items';
        $r = 'budget_items';
        $fk = 'category';
        runDelete($t, $p, $r, $fk);
    }
    if(isset($_POST['delete_item'])){
        $t = 'budget_items';
        $p = 'dash_items';
        $r = '';
        $fk = '';
        runDelete($t, $p, $r, $fk);
    }
    function runDelete($table, $page, $ref_table, $f_key){
        $i = $_POST['id'];
        //var_dump($i);
        if($ref_table > ''){
            $qry = "SELECT * FROM $ref_table WHERE $f_key = '$i'";
            $ref = specialQuery($qry);
            if(empty($ref)){
                delete($table, $i);
                $_SESSION['msg'] = "deleted";
                header("location: ../dashboard/$page.php");
            }
            else{
                $_SESSION['msg'] = "delete_f";
                header("location: ../dashboard/$page.php");
            }
        }
        else{
            delete($table, $i);
            $_SESSION['msg'] = "deleted";
            header("location: ../dashboard/$page.php");
        }
                
    }  
    
?>