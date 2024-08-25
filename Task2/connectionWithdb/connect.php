<?php
    namespace Task2\connectionWithdb;
    // require_once '../Article_blog/delete_post.php';
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    class Database{      
    public $servername = "localhost";
    public $username = "root";
    public $password = '';
    public $db_name = "blog_db";
    public $conn ; 
    public $id ;
    public $action ; 
    // public function __construct(){
    //     $this->id = isset($_REQUEST['id'])? $_REQUEST['id']: null;
    // }
    public function Connect(){
        $this->conn = new \mysqli($this->servername , $this->username ,$this->password , $this->db_name);
        if($this->conn->connect_error){
            echo $this->conn->connect_error ; 
        }
        else{
            // echo "connected with db successfuly";
        }
    }

    public function execute($query  , $parameter = []){
        $this->Connect();

        if($this->conn === null){
             throw new \Exception("Database connection not established.");
        }

        $statment = $this->conn->prepare($query);

        if($statment === false){
            throw new \Exception("Prepare failed: " . $this->conn->error);
        }

        if(empty($parameter)){
            die("parameter is empty");
        }

        $types = str_repeat('s' , count($parameter));
        
        if(empty($types)){
            die("types string is empty");
        }
        $statment->bind_param($types , ...$parameter);
        return $statment->execute();
    }


    public function display($query){
        if($this->conn != null){
            $result = $this->conn->query($query);
            if($result->num_rows <= 0){
                    echo "No result<br>";
            }
            else {
                echo '<div class="container mt-4">';
                echo '<table class="table table-striped table-bordered">';
                echo '<thead class="thead-light">';
                echo '<tr>';
                while ($info = $result->fetch_field()) {
                echo "<th>$info->name</th>";
                }
                echo "<th>Action</th>";
                echo "<tr/>";

                echo '</thead>';
                echo '<tbody>';
                while ($val = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($val as $data) {
                echo "<td>{$data}</td>";
                }
                echo "<td class='d-flex justify-content-between'>"; 
                echo '<a href="../Article_blog/edit_post.php?id=' . $val['id'] . '&action=update" class="btn btn-primary btn-sm me-1">Update</a>'; 
                echo '<a href="../Article_blog/view_post.php?id=' . $val['id'] . '&action=read" class="btn btn-info btn-sm me-1">Show</a>'; 
                echo '<a href="../Article_blog/article.php?id=' . $val['id'] . '&action=delete" class="btn btn-danger btn-sm">Delete</a>';
                echo "</td>";
                echo "</tr>";
                }
                echo '</tbody>';
                echo '</table>';
                echo '</div>';

            }
        }
    }
}
$obj1 = new Database();
$obj1->Connect();
?>