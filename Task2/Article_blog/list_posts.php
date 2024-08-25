<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../style/Style_Button_Create.css?v=5487"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>All Articles</title>
</head>
<body>
    <?php $user_id = $_SESSION['user_id'];  ?>
    
        <!-- <a href="Create_post.php?action=create&user_id=<php echo $user_id; ?>">Add</a> -->
        <a href="Create_post.php?action=create&user_id=<?php echo $user_id; ?>">Add</a>
    
    <div class="container" style="display: none;">
        <?php require_once '../Article_blog/article.php'; ?>
    </div>
<?php
    use \Task2\Article_blog\Post as post ; 
    $obj2 = new post();
    $obj2->listAll();
?>
<!-- <script src="../JS folder/dont_delete.js"></script>    -->
</body>
</html>