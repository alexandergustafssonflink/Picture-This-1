<?php

declare(strict_types=1);

$statement = $pdo->prepare('SELECT * FROM user WHERE id = :id');
$statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
$statement->execute();

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
    
$user = $statement->fetch(PDO::FETCH_ASSOC);

unset($user['password']);

$_SESSION['user'] = $user;