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
    
<article class= "edit-wrapper">
    <?php if(isset($_SESSION['error'])):?>
        <p class="error-message"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']);?>
    <?php endif;?>
        <form action="app/users/upload-profile-picture.php" method="post" enctype="multipart/form-data">
        <div class="fileinputs">
        <?php if ($avatar['data']!== NULL):?>
            <img src="<?php echo "/app/users/uploads/".$avatar['data'];?>" alt="avatar image" class="avatar" loading="lazy">
            <?php else : ?> 
                <p>Upload your profile avatar image</p>
            <?php endif ; ?>
            
            <input type="file" name="profile-img" accept="image/*" class="choose-file" loading="lazy">
            <input type="submit" class="upload-button" value="Upload"></input> 
            
        </div> <!-- /fileinputs -->
    <p class="edit-text"> Edit your account email, password and biography.</p>
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
<?php require __DIR__.'/views/footer.php'; ?>
