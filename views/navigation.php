<!-- <div class="hamburger-icon">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
</div> -->

<nav class="mobile-title">
    <a class="navigation-title-mobile" href="/index.php"><?php echo $config['title']; ?></a>
</nav>

<nav class="navbar">
    <div class="nav-items">
        <ul>
            <li class="nav-item">
                <a class="navigation-title" href="/index.php"><?php echo $config['title']; ?></a>
            </li><!-- /nav-item -->
            
            <div class= "nav-icons">
                <li class="nav-item">
                    <a class="nav-link" href="app/users/logout.php"><img src="assets/icons/logout.png" alt="" width = 32px height = 32px ></a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link" href="/account.php"><img src="assets/icons/myaccount.png" width = 32px height = 32px ></a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link" href="/create-post.php"><img src="assets/icons/create.png" width = 32px height = 32px ></a>
                </li><!-- /nav-item -->
            </div>
        </ul>
    </div> <!-- nav-items -->
</nav><!-- /navbar -->
