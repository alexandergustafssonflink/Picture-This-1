<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/app/parse.php';
    require __DIR__.'/views/navigation.php'; 
}

if(isset($_GET['id'])){
    $postId = (int) $_GET['id'];
    $post = getPostById($userId, $postId, $pdo);
}

if(isset($_SESSION['error'])):?>
    <p class="error-message"><?php echo $_SESSION['error']; ?></p>
    <?php unset($_SESSION['error']);?>
<?php endif ;?>

<nav class="nav-top">
    <h1><?php echo $config['title']; ?></h1>
</nav>

<article>
    <form action="<?php echo '/app/posts/update.php?id='. $postId ?>" method="post" enctype="multipart/form-data" class="edit-post-form">
    <img src="<?php echo '/app/posts/uploads/images/'.$post['data']?>" alt="post-image" loading="lazy">
    <?php if(isset($_SESSION['success'])):?>
        <p class="success-message"><?php echo $_SESSION['success']; ?></p>
        <?php unset($_SESSION['sucess']);?>
    <?php endif;?>
    <p>Update your post image and/or description</p>
    <input type="file" name="edit-post-image" accept="image/*" class="choose-file">
    
    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" name="description" id="description" cols="30" rows="10"><?php echo $post['description']; ?></textarea>
    </div>
    <input type="submit" class="update-button" value="Update"></input>
    </form>
</article>

<article>
    <form action="<?php echo '/app/posts/delete.php?id='. $postId ?>" method="post" class="edit-post-form">
        <div class="form-group">
            <label for="password">Enter your password to delete post</label>
            <input type="password" name="password" id="password" required>
        </div>
        <input type="submit" class="delete-button" value="Delete post"></input>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>