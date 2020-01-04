<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/app/parse.php';
    require __DIR__.'/views/navigation.php'; 
    $imageId = (int) $user['image_id'];
    $avatar = getAvatarbyId($imageId, $pdo);
}
?>
<main class="account-wrapper"> 

    <nav class= "nav-top">
    <h1 class="title"><?php echo $config['title']; ?> </h1>
</nav>


<form action="app/users/upload-profile-picture.php" method="post" enctype="multipart/form-data">
    <div class="fileinputs">
        <?php if ($avatar['data'] !== NULL):?>
            <img src="<?php echo "/app/users/uploads/avatars/".$avatar['data'];?>" alt="avatar image" class="avatar">
        <?php else : ?> 
            <p>Upload your profile avatar image</p>
        <?php endif ; ?>

        <div class="form-group">
        <input type="file" name="profile-img" accept="image/*">
        <input type="submit" class="upload-button" value="Upload"></input>
    </div><!-- /form-group -->
    </div>
</form>

    <p>Edit your account email, password and biography</p>
    
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
            <textarea type="text" name="biography" id="biography" cols="30" rows="5" placeholder="Bio"><?php echo $user['biography']?></textarea>
        </div><!-- /form-group -->
        <input type="submit" class="submit-button" value="Submit"></input>
        
    </form>

</main> <!-- /account-wrapper -->
</article>


<?php require __DIR__.'/views/footer.php'; ?>
