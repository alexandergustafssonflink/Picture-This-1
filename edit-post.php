<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/app/parse.php';
}

if(isset($_GET['id'])){
    $postId = (int) $_GET['id'];
    $post = getPostById($userId, $postId, $pdo);
}
?>

<main>
    <h1><?php echo $config['title']; ?></h1>
    <p>Update posts image and description</p>
</main>

<article>
    <form action="<?php echo '/app/posts/update.php?id='. $postId ?>" method="post" enctype="multipart/form-data">
        <div>
            <img src="<?php echo '/app/posts/uploads/images/'.$post['data']?>" alt="">
            <input type="file" name="edit-post-image" accept="image/*">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" cols="30" rows="10"><?php echo $post['description']; ?></textarea>
        </div>
        <button type="submit" class="update-button">Update</button>
    </form>
</article>

<article>
    <form action="<?php echo '/app/posts/delete.php?id='. $postId ?>" method="post">
        <label for="password">Enter your password to delete post</label>
        <input type="password" name="password" id="password" required>
        <button type="submit" class="delete-button">Delete post</button>
    </form>
</article>

    

<?php require __DIR__.'/views/footer.php'; ?>