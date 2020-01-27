<?php
// IN HERE WE STORE COMMENTS
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$user = $_SESSION['user'];
$id = $user['id'];

if (isset($_POST['search-user'])) {
    $searchTerm = trim(filter_var($_POST['search-user'], FILTER_SANITIZE_STRING));

    getSearchResult($searchTerm, $pdo);

    redirect('/../search-user.php');
}
