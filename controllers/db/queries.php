<?php
    session_start();
    include "connect.php"; //including the connection to the db

    // a function that gets data from the db
    function getData($table){
        global $conn; //including a $conn global variable in the function
        $sql = "SELECT * FROM $table"; //defining our query structure
        $query = $conn->prepare($sql); //preparing the query
        $query->execute(); //executing the query
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC); //adding the data to a $result variable as an associative array
        return $result;
    }

    function addData($sql){
        global $conn;
        $query = $conn->prepare($sql);
        $query->execute();
    }

    function getUser($email){
        global $conn;
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $result = $query->get_result();
        return $result;
    }
    function getDepartment($user){
        global $conn;
        $sql = "SELECT * FROM budgeting_entity WHERE incharge = '$user'";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $result = $query->get_result();
        return $result;
    }
?>