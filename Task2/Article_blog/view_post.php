<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/Style_view_post.css">
    <title>view article</title>
</head>
<body>
    <div class="container" style="display: none;">
        <?php require_once '../Article_blog/article.php';?>
    </div>
    <?php
        use \Task2\Article_blog\Post as post; 
        $id = $_GET['id']?? null;
        if($id){
            $obj6 = new Post();
            $row = $obj6->read($id) ; 
            $content = $row['content'];
            $author = $row['author'];
            echo "<h1>Article Content</h1>";
            echo "<h3>Author Name: $author</h3>";
            echo "<div class='content'>$content</div>";
        }
    ?>
</body>
</html>
