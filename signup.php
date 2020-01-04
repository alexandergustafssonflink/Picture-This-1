<?php require __DIR__.'/views/header.php'; ?>

<article class ="get-welcome-page">
    <div>
        <h1><?php echo $config['title']; ?></h1>
        <p>Sign up to see photos from your friends</p>
    </div>
    
    <form action="app/users/signup.php" method="post" class="form-wrapper">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div><!-- /form-group -->

        <div class="form-group">    
            <label for="password-repeat">Repeat password</label>
            <input class="form-control" type="password" name="password-repeat" id="password-repeat" required>
        </div><!-- /form-group -->

        <input type="submit" class="signup-button" value="Signup"></input>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>