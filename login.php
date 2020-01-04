<?php require __DIR__.'/views/header.php'; ?>

<article class="get-welcome-page">
    <div>
        <h1 class="title"><?php echo $config['title']; ?> </h1>
        <p>Login to see photos from your friends</p>
    </div>
    
    <form action="app/users/login.php" method="post" class="form-wrapper">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div><!-- /form-group -->

        <input type="submit" value="Login">
    </form> 
</article> <!-- /login-page -->

<?php require __DIR__.'/views/footer.php'; ?>