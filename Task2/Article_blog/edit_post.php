<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../style/Style_Update.css?v=1"> -->
    <title>Update_Post</title>
</head>
<body>
    <div class="container" style="display: none;">
        <?php  require_once '../Article_blog/article.php'; ?>
    </div>
    <?php 
        
        use \Task2\Article_blog\Post as post ;
        $id = $_GET['id'] ?? null ;
        if($id){
            $obj = new post();
            $article = $obj->getArticleById($id);
            $title = $article['title'];
            $content = $article['content'];
            $author = $article['author'];
            $created_at = $article['created_at'];
        }
        $action = $_REQUEST['action'];
    ?>
<form action="article.php" method="post" class="container mt-5 p-4 border rounded bg-light shadow">
    <h2 class="mb-4 text-center text-primary">Update Article</h2>

    <input type="hidden" name="action" value="<?php echo htmlspecialchars($action); ?>">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>">
        </div>

        <div class="col-md-6">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="<?php echo htmlspecialchars($author); ?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control" rows="6"><?php echo htmlspecialchars($content); ?></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="created_at" class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" value="<?php echo htmlspecialchars($created_at); ?>" readonly>
        </div>

        <div class="col-md-6">
            <label for="updated_at" class="form-label">Updated At</label>
            <input type="text" name="updated_at" id="updated_at" class="form-control" value="<?php date_default_timezone_set('Asia/Riyadh'); echo date('Y-m-d H:i:s'); ?>" readonly>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg px-5">Update</button>
    </div>
</form>
</body>
</html>