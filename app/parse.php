<?php
declare(strict_types=1);

//fetch the signed up user and insert to SESSION[user]
$statement = $pdo->prepare('SELECT * FROM user WHERE id = :id');
if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
$statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);
unset($user['password']);
$_SESSION['user'] = $user;
$userId = (int) $_SESSION['user']['id'];


//fetch all posts with image and description
$statement=$pdo->prepare("SELECT * FROM image INNER JOIN post ON image.id = image_id;");
if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
