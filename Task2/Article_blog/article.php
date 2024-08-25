<?php
    namespace Task2\Article_blog; 
session_start();
    require_once '../connectionWithdb/connect.php';
    // require_once '../Article_blog/edit_post.php';
    use \Task2\connectionWithdb\Database as Database; 
    class Post{
        public $id         ; 
        public $user_id; 
        public $title      ; 
        public $content    ; 
        public $author     ; 
        public $created_at ; 
        public $updated_at ; 
        public function __construct(){
            $this->id = $_REQUEST['id'] ?? null;
            $this->user_id = $_GET['user_id'] ?? null ;
        }
        public function Create_Article($title , $content , $author , $user_id){
            $this->title = $title;
            $this->content = $content ; 
            $this->author = $author; 
            $this->user_id=  $user_id;

            $obj2 = new Database();
            $obj2->Connect();
            $query = "INSERT INTO posts (title, content, author, created_at, updated_at , user_id) VALUES(? , ?, ? , NOW() , NOW() , ?)";
            $parameter = [$this->title , $this->content , $this->author , $this->user_id];
            $obj2->execute($query , $parameter);
            
            header('Location:list_posts.php');
            exit();
            
        }
        public function Update_Article($title , $content , $author , $updated_at){
            $this->title = $title ; 
            $this->content = $content ; 
            $this->author = $author;
            $this->updated_at = $updated_at; 

            $obj2 = new Database();
            $obj2->Connect();
            $query = "UPDATE posts SET title = ?, content = ?, author = ?  , updated_at = ? WHERE id = ?";
            $parameter = [$this->title , $this->content , $this->author ,$this->updated_at, $this->id];
            $obj2->execute($query , $parameter);
            header('Location:list_posts.php');
            exit();  // تأكد من إنهاء السكربت بعد إعادة التوجيه
        }
        public function read($id){
            $id = $_GET['id'];
            $obj7 = new Database();
            $obj7->Connect();
            $query = "SELECT content , author FROM posts WHERE id = ?";
            $parameter = [$id];
            $stmt = $obj7->conn->prepare($query);// تحضير الاستعلام
            $stmt->bind_param('i' , $id);// ربط المعاملات 
            $stmt->execute();   //تنفيذ الاستعلام
            $result = $stmt->get_result();
            if($result->num_rows <= 0){
                die("sorry No result");
            }else{
                $row = $result->fetch_assoc();
                // return $row['content'];
                return $row ;
            }
        }
        public function delete($id , $user_id){
            $obj1 =  new Database();
            $obj1->Connect();
            $id = $_GET['id'];
            $user_id = $_SESSION['user_id'];
            $query = "DELETE FROM posts WHERE id = ? AND user_id = ?";
            $stmt = $obj1->conn->prepare($query);
            $stmt->bind_param('ii',  $id , $user_id);
            if($stmt->execute()){
                if($stmt->affected_rows>0){
                    header('Location:list_posts.php');
                    exit();
                }
                else{
                echo 
                "<script>
                    alert('You cannot delete this article because you are not the one who added It');
                    window.location.href = 'list_posts.php';
                </script>";
                exit();
                }
            }else{
                echo 
                "<script>
                    alert('an error eccurred while trying to delete the article');
                    window.location.href= 'list_posts.php';
                </script>";
            }
        }
        public function getArticleById($id){
            $obj1 = new Database();
            $obj1->Connect();
            $id = $_GET['id']; 
            $query  = "SELECT * FROM posts WHERE id = ?";
            $stmt = $obj1->conn->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row; 
        }
        public function listAll(){
            $obj1 = new Database();
            $obj1->Connect();
            $query = "SELECT id , title , author , created_at, updated_at FROM posts";
            $obj1->display($query);
        }
    }
        $obj4 = new Post();
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        $user_id = $_POST['user_id'] ?? $_GET['user_id']?? null ;
        if($action == '' ){
            echo "no action ";
            return false;
        }
        if($action == 'delete' && $obj4->id){
            $user_id = $_SESSION['user_id'];
            $obj4->delete($obj4->id , $user_id);
        }
        // else if(!$obj4->user_id){
        //     echo "<script>
        //     alert('You cannot delete this article because you are not the one who added It');
        //      window.location.href = 'list_posts.php';
        //     </script>";
        // }
        
        
        if ($action && isset($_POST['title'], $_POST['content'], $_POST['author'])) {
            if ($action == 'update' && $obj4->id) {
                $obj4->Update_Article($_POST['title'], $_POST['content'], $_POST['author'] , $_POST['updated_at']);
            } elseif ($action == 'create') {
                if($_POST['title']== ''){echo "Error (title is empty)"; return false ;}
                else if($_POST['content']==''){echo "Error (content is empty)"; return false; }
                else if($_POST['author']==''){echo "Error (author name is empty)"; return false ;}
                else{
                    $user_id = $_POST['user_id'] ?? $_GET['user_id']?? null ;
                    $obj4->Create_Article($_POST['title'], $_POST['content'], $_POST['author'] , $user_id);
                }
            }else if($action == 'read' && $obj4->id){
                echo $obj4->read($obj4->id);
            }else {
                echo "Invalid action or missing ID for update.";
                return false;
            }
        }   
        else {
            echo "Required fields are missing.";
        }
?>