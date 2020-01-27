<?php require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
} else {
    require __DIR__ . '/app/parse.php';
    require __DIR__ . '/views/navigation.php';
    $user = $_SESSION['user'];
}
?>


<article class="search-wrapper">
    <div>
        <h1> Search user by name
        </h1>
        <form action="/search-user.php" method="get">
            <div class="form-group">
                <label for="">Email</label>
                <input name="search" placeholder="Searchie Searchson" required>
                <button type="submit">Search!</button>
            </div>

            <?php if (isset($_GET['search'])) : ?>
                <?php
                $searchTerm = $_GET['search'];
                $searchresults = getSearchResult($searchTerm, $pdo);
                ?>

                <div class="searchResult">

                    <h2>Search results... </h2>

                    <?php if ($searchresults !== FALSE) : ?>

                        <?php foreach ($searchresults as $result) : ?>
                            <h3> <?php echo $result['email']; ?></h3>

                        <?php endforeach; ?>

                    <?php else : ?>
                        <h3>Sorry, not match was found </h3>
                    <?php endif; ?>


                <?php endif; ?>



                </div>
    </div> <!-- follow-buttons-wrapper -->
</article> <!-- /profile-wrapper-->


<?php require __DIR__ . '/views/footer.php'; ?>