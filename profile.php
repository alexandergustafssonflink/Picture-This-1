<?php require __DIR__.'/views/header.php'; ?>
<?php require __DIR__.'/app/users/parse.php';?> 
<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Edit your account email, password and biography</p>
    <p>Upload your profile avatar image</p>
</article>
<?php echo $user['email'] ?>
<main>
    <h1><?php echo $config['title']; ?></h1>
    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="<?=$user['email']?>" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="biography">Biography</label>
            <textarea name="biography" id="biography" cols="30" rows="10"><?php echo $user['biography']?></textarea>
        </div><!-- /form-group -->

        <button type="submit" class="submit-button">Submit</button>
    </form>
</main>

<?php require __DIR__.'/views/footer.php'; ?>
