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

    // DELETES COMMENT
    $sql = "DELETE from comment WHERE id = :id";
    $statement = $pdo->prepare($sql);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $response  = [
        'removeComment' => true
    ];

    echo json_encode($response);

    exit;
}
