<?php
    require_once '../connectionWithdb/connect.php';
    use \Task2\connectionWithdb\Database as Database;
    if(isset($_REQUEST["id"])&& is_numeric($_REQUEST["id"])){
        $id = intval($_REQUEST["id"]);

        $obj5= new Database();
        $query = "DELETE FROM posts WHERE id = ?";
        $obj5->Connect();
        $stmt = $obj5->conn->prepare($query);
        if($stmt == false){
            die("prepare failed " . $obj5->conn->error);
        }
        $stmt->bind_param('i' , $id);
        if($stmt->execute()){
            header('Location: list_posts.php');
            exit();
        }
        else{
            echo "Execute failed";
        }
    }
    else{
        echo "invalid id";
    }   

