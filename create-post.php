<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
}
?>

<main>
    <h1><?php echo $config['title']; ?></h1>
    <p>Create posts with image and description</p>
</main>

<article>
    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">
        <div>
            <input type="file" name="post-img" accept="image/*">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="upload-button">Upload</button>
    </form>
</article>

    

<?php require __DIR__.'/views/footer.php'; ?>