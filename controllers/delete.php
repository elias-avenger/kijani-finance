<?php
    include "db/queries.php";
    if(isset($_POST['delete_user']))
        $t = 'users';
    $i = $_POST['id'];
    var_dump($i);
    delete($t, $i);
    header("location: ../dashboard/dash_users.php");
?>