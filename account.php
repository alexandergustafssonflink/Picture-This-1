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
  
    
<article class= "edit-wrapper">
    <?php if(isset($_SESSION['error'])):?>
        <p class="error-message"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']);?>
    <?php endif;?>
        <form action="app/users/upload-profile-picture.php" method="post" enctype="multipart/form-data">
        <div class="fileinputs">
        <?php if ($avatar['data'] !== NULL):?>
            <img src="<?php echo "/app/users/uploads/avatars/".$avatar['data'];?>" alt="avatar image" class="avatar" loading="lazy">
            <?php else : ?> 
                <p>Upload your profile avatar image</p>
            <?php endif ; ?>
            
            <input type="file" name="profile-img" accept="image/*" class="choose-file" loading="lazy">
            <input type="submit" class="upload-button" value="Upload"></input> 
            
        </div> <!-- /fileinputs -->
    <p class="edit-text">Upload profile picture <br> Edit your account email, password and biography.</p>
            </form>
            
    
    <form action="app/users/editaccount.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="edit-input"type="email" name="email" id="email" value="<?php echo $user['email']?>">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="edit-input"type="password" name="password" id="password">
            <label for="password-repeat" >Repeat password</label>
            <input class="edit-input"type="password" name="password-repeat" id="password-repeat" >
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea type="text" name="biography" id="biography" cols="30" rows="5" placeholder="Bio"><?php echo $user['biography']?></textarea>
            <input type="submit" class="submit-button" value="Submit"></input>
        </div><!-- /form-group -->
    </form>
    </article> <!-- /edit-wrapper -->
</main> <!-- /account-wrapper -->
<?php require __DIR__.'/views/footer.php'; ?>
