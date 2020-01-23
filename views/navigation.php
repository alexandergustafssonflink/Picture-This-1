<nav class="mobile-title">
    <a class="navigation-title-mobile" href="/index.php"><?php echo $config['title']; ?></a>
    <div class="hamburger-icon">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</nav>

<nav class="mobile-navbar">
    <ul class="mobile-nav-items">
        <li class="mobile-nav-item">
            <a class="mobile-nav-link" href="/myaccount.php">My account</a>
        </li><!-- /mobile-nav-item -->

        <li class="mobile-nav-item">
            <a class="mobile-nav-link" href="/create-post.php">Create post</a>
        </li><!-- /mobile-nav-item -->

        <li class="mobile-nav-item">
            <a class="mobile-nav-link" href="/search-user.php">Search user</a>
        </li><!-- /mobile-nav-item -->

        <li class="mobile-nav-item">
            <a class="mobile-nav-link" id="modal-btn">Logout</a>
        </li><!-- /mobile-nav-item -->
    </ul> <!-- mobile-nav-items -->
</nav><!-- /mobile-navbar -->

<nav class="desktop-navbar">
    <div class="nav-items">
        <ul>
            <li class="nav-item">
                <a class="navigation-title" href="/index.php"><?php echo $config['title']; ?></a>
            </li><!-- /nav-item -->

            <div class="nav-icons">
                <li class="nav-item">
                    <a class="nav-link" id="modal-btn-desktop"><img src="assets/icons/logout.png" alt="" width=32px height=32px></a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link" href="/myaccount.php"><img src="assets/icons/myaccount.png" width=32px height=32px></a>
                </li><!-- /nav-item -->

                <li class="nav-item">
                    <a class="nav-link" href="/create-post.php"><img src="assets/icons/create.png" width=32px height=32px></a>
                </li><!-- /nav-item -->
            </div>
        </ul>
    </div> <!-- nav-items -->
</nav><!-- /navbar -->

<div class="modal">
    <div class="modal-content">
        <p>Are you sure you want to log out?</p>
        <a class="yes-btn" href="app/users/logout.php">Yes!</a>
        <button class="close-btn">Cancel</button>
    </div>
</div>