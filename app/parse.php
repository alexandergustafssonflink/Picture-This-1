<?php

declare(strict_types=1);
//fetch user table from database and insert to SESSION
$statement = $pdo->prepare('SELECT * FROM user WHERE id = :id');
$statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);
unset($user['password']);
$_SESSION['user'] = $user;
$userId = (int) $_SESSION['user']['id'];


//fetch avatar filename(data) from database and insert to variable to use in profile.php
$statement=$pdo->prepare("SELECT data FROM user INNER JOIN image ON user.image_id = :imageid;");
$statement->bindParam(':imageid', $user['image_id'], PDO::PARAM_STR);
$statement->execute();
$avatar = $statement->fetch(PDO::FETCH_ASSOC);

//fetch image filename(data) and description from table image and post. Use variable in index.php
$statement=$pdo->prepare("SELECT * FROM image INNER JOIN post ON image.id = image_id;");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}


function getPostById(int $userId, int $postId, PDO $pdo): array
{
    $statement=$pdo->prepare('SELECT * FROM post INNER JOIN image ON image_id = image.id WHERE user_id = :userid AND post.id = :postid');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userid', $userId, PDO::PARAM_STR);
    $statement->bindParam(':postid', $postId, PDO::PARAM_STR);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    if($post){
        return $post;
    }
}

function countLikes(int $postId, PDO $pdo): int
{
    $statement=$pdo->prepare('SELECT COUNT(*) FROM like WHERE post_id = :postId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':postId', $postId, PDO::PARAM_STR);
    $statement->execute();
    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$likes['COUNT(*)'];
}