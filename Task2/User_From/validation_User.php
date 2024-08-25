<?php
session_start();
    require_once '../connectionWithdb/connect.php';
    use \Task2\connectionWithdb\Database as Database ;
    $obj3 = new Database();
    if($_REQUEST['name'] == ''){
        echo "please fill user name";
        return false;
    }else if($_REQUEST['Email'] == '' ){
        echo "please fill Eamil field";
        return false; 
    }else if($_REQUEST['Password'] == ''){
        echo "please fill Password field";
        return false; 
    }else{
        $UserName = $_REQUEST['name'];
        $Email = $_REQUEST['Email'];
        $pwd = $_REQUEST['Password'];
        $id = $_REQUEST['user_id'];
        $obj3->Connect();
        $query = "INSERT INTO Users (name , Email , Password)  values (? , ? , ?)";
        $stmt = $obj3->conn->prepare($query);
        $stmt->bind_param('sss' , $UserName , $Email , $pwd);
        $stmt->execute();
        $id = $obj3->conn->insert_id ;
        $_SESSION['user_id'] = $id;
        header('Location: ../Article_blog/list_posts.php?user_id='.$id);
        exit();

    }
?>