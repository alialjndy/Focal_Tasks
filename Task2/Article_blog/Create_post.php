<?php
    // require_once '../Article_blog/article.php';
    use \Task2\Article_blog\Post as Post ;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../style/Style_Create_Article.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Create Post</title>
</head>
<body>
    <?php $action = $_GET['action']; ?>

   
    


<form action="article.php" method="post" class="container mt-5 p-4 border rounded bg-light shadow">
    <h2 class="mb-4 text-center text-primary">Create Article</h2>

    <input type="hidden" name="action" value="<?php echo htmlspecialchars($action); ?>">
    <input type="text" name="id" hidden>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" placeholder="Title" id="" class="form-control">
        </div>

        <div class="col-md-6">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control" rows="6"></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="created_at" class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
        </div>

        <div class="col-md-6">
            <label for="updated_at" class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
        </div>

        <div class="col-md-6">
            <label for="updated_at" class="form-label"></label>
            <input type="text" name="user_id" class="form-control" value="<?php echo $_GET['user_id']; ?>" readonly hidden >
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg px-5">Create</button>
    </div>
</form>


</body>
</html> 