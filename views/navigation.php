<?php if(!isset($_SESSION['user'])): ?>
    <ul class="navbar-not-logged-in">
        <li class="nav-item">
            <a class="nav-button" href="/signup.php">Signup</a>
        </li><!-- /nav-item -->
        
        <li class="nav-item">
            <a class="nav-button" href="/login.php">Login</a>
        </li><!-- /nav-item -->
    </ul><!-- /navbar-not-logged-in -->

    
<?php else: ?>
<nav class="navbar">
    <a class="navigation-title" href="/index.php"><?php echo $config['title']; ?></a>
    <ul class="navbar">
    <li class="nav-item">
        <a class="nav-link" href="app/users/logout.php">Logout</a>
    </li><!-- /nav-item -->

    <li class="nav-item">
        <a class="nav-link" href="/account.php">Account</a>
    </li><!-- /nav-item -->

    <li class="nav-item">
        <a class="nav-link" href="/create-post.php">Create post</a>
    </li><!-- /nav-item -->
    </ul><!-- /navbar-logged-in -->
</nav><!-- /navbar -->
<?php endif ; ?>
