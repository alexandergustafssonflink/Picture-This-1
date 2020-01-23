<?php require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
} else {
    require __DIR__ . '/app/parse.php';
    require __DIR__ . '/views/navigation.php';
}
?>

<article class="profile-wrapper">
    <div>

        <h1> Search user by name
        </h1>
        <form action="app/users/search-user.php" method="post">
            <div class="form-group">
                <label for="">Email</label>
                <input name="search-user" placeholder="Searchie Searchson" required>
                <button type="submit">Search!</button>
            </div>



    </div> <!-- follow-buttons-wrapper -->
</article> <!-- /profile-wrapper-->


<?php require __DIR__ . '/views/footer.php'; ?>