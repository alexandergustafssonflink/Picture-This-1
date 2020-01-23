<?php
// IN HERE WE STORE COMMENTS
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$user = $_SESSION['user'];
$id = $user['id'];

if (isset($_POST['search-user'])) {
    $searchTerm = trim(filter_var($_POST['search-user'], FILTER_SANITIZE_STRING));

    $sql = "SELECT * FROM user WHERE email LIKE '% :searchTerm %' ";

    $statement = $pdo->prepare($sql);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

    // $statement->execute();

    $searchResult = $statement->fetchAll(PDO::FETCH_ASSOC);
    die(var_dump($searchResult));


    redirect('/post.php?id=' . $_GET['id']);
}
