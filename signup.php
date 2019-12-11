<?php require __DIR__.'/views/header.php'; ?>

<main>
    <h1><?php echo $config['title']; ?></h1>
    <h2>Sign up to see photos from your friends</h2>
    <form action="app/users/signup.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="password-repeat">Repeat password</label>
            <input class="form-control" type="password" name="password-repeat" id="password-repeat" required>
        </div><!-- /form-group -->

        <button type="submit" class="signup-button">Signup</button>
    </form>
</main>

<?php require __DIR__.'/views/footer.php'; ?>