<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/app/parse.php';
    $imageId = (int) $user['image_id'];
    $avatar = getAvatarbyId($imageId, $pdo);
}
?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Edit your account email, password and biography</p>
    <p>Upload your profile avatar image</p>
</article>

<main>
    <h1><?php echo $config['title']; ?></h1>
    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $user['email']?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="password-repeat">Repeat password</label>
            <input type="password" name="password-repeat" id="password-repeat" >
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea type="text" name="biography" id="biography" cols="30" rows="10"><?php echo $user['biography']?></textarea>
        </div><!-- /form-group -->
        
        <button type="submit" class="submit-button">Submit</button>
    </form>

    <form action="app/users/upload-profile-picture.php" method="post" enctype="multipart/form-data">
    <div>
            <?php if ($avatar['data'] !== NULL):?>
                <img src="<?php echo "/app/users/uploads/avatars/".$avatar['data'];?>" alt="avatar image">
            <?php endif ; ?>
            <input type="file" name="profile-img" accept="image/*">
            <button type="submit" class="upload-button">Upload</button>
        </div>
    </form>
</main>

<?php require __DIR__.'/views/footer.php'; ?>
