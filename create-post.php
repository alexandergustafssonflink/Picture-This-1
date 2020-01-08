<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/views/navigation.php'; 
}
?>

<nav class="nav-top">
    <h1><?php echo $config['title']; ?></h1>
</nav>

<form action="app/posts/store.php" method="post" enctype="multipart/form-data" class="postform-wrapper">
    <?php if(isset($_SESSION['error'])):?>
        <p class="error-message"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']);?>
    <?php endif;?>
    <p class="create-post-text">Create a post with image and description</p>
    <div class="create-post-content">
        <input type="file" name="post-image" accept="image/*" class= "choose-file">
            
        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" class="upload-button" value="Upload" class="input-file"></input>
    </div>

</form>

    

<?php require __DIR__.'/views/footer.php'; ?>