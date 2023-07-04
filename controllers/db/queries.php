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
        $sql = "SELECT * FROM budgeting_entities WHERE incharge = '$user'";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $result = $query->get_result();
        return $result;
    }
    function delete($table, $id){
        global $conn;
        $sql = "DELETE FROM $table WHERE id = $id";
        $query = $conn -> prepare($sql);
        $query -> execute();
    }
    function specialQuery($sql){
        global $conn;
        $query = $conn -> prepare($sql);
        $query -> execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    function update($sql){
        global $conn;
        $query = $conn->prepare($sql);
        $query->execute();
    }
    function specialNoResult($sql){
        global $conn;
        $query = $conn -> prepare($sql);
        $query -> execute();
        $result = $query->get_result();
        return $result;
    }
    function selectCountWhere($table, $field, $val){
        global $conn;
        $sql = "SELECT COUNT(id) FROM $table WHERE $field = '$val'";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result()->fetch_column();
        return $result;
    }
    function selectMAx($table, $field){
        global $conn;
        $sql = "SELECT MAX($field) FROM $table";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result()->fetch_column();
        return $result;
    }
?>