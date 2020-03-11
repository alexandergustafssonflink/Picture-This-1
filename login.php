<?php require __DIR__.'/views/header.php'; ?>

<article class="get-welcome-page">
    <div>
        <a href="/index.php">
            <h1 class="title"><?php echo $config['title']; ?> </h1>
        </a>    
        <p>Login to see photos from your friends</p>
    </div>

    <?php if (isset($_SESSION['error'])):?>
            <p class="error-message"><?php echo $_SESSION['error']; ?></p>
            <?php unset($_SESSION['error']);?>
    <?php endif ;?>
    
    <form action="app/users/login.php" method="post" class="form-wrapper">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div><!-- /form-group -->

        <input type="submit" value="Login" class="login-button">
    </form> 
    <div class="option">
        <p>Or do you want to</p>
        <a class="nav-button" href="/signup.php">Sign up</a>
    </div>
</article> <!-- /get-welcome-page -->

<?php require __DIR__.'/views/footer.php'; ?>