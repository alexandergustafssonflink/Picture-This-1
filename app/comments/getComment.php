<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // FETCHES COMMENT
    $statement = $pdo->prepare('SELECT * FROM comment WHERE id = :id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $comment = $statement->fetch();

    echo json_encode($comment);

    exit;
}
