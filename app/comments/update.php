<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

$user = $_SESSION['user'];

if (isset($_POST['content'], $_POST['id'])) {

    $content = trim(filter_var($_POST['content'], FILTER_SANITIZE_STRING));
    $id = $_POST['id'];

    $sql = 'UPDATE comment SET comment = :content WHERE id = :id';
    $statement = $pdo->prepare($sql);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();


    // FETCHES COMMENT
    $statement = $pdo->prepare('SELECT * FROM comment WHERE id = :id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $comment = $statement->fetch();
    $pdo->lastInsertId();

    echo json_encode($comment['comment']);
    exit;
}
