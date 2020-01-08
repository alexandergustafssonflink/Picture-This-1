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
function getAvatarbyId(int $imageId, PDO $pdo)
{
    $statement=$pdo->prepare("SELECT data FROM user INNER JOIN image ON user.image_id = image.id WHERE image.id = :imageId");
    $statement->bindParam(':imageId', $imageId, PDO::PARAM_INT);
    $statement->execute();
    $avatar = $statement->fetch(PDO::FETCH_ASSOC);
    if($avatar){
        return $avatar;
    }
}


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
    $statement->bindParam(':userid', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postid', $postId, PDO::PARAM_INT);
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
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$likes['COUNT(*)'];
}

function getUserById(int $userId, PDO $pdo): array
{
    $statement=$pdo->prepare('SELECT * FROM user WHERE id = :userId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $author = $statement->fetch(PDO::FETCH_ASSOC);

    if($author){
        return $author;
    }
}

function countFollowers(int $chosenUserId, PDO $pdo): int
{
    $statement=$pdo->prepare('SELECT COUNT(*) FROM follow WHERE user_id_1 = :userId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $chosenUserId, PDO::PARAM_INT);
    $statement->execute();
    $followers = $statement->fetch(PDO::FETCH_ASSOC);

    return (int)$followers['COUNT(*)'];
}

function getLikeRowById(int $userId, int $postId, PDO $pdo){
    $statement=$pdo->prepare('SELECT * FROM like WHERE user_id = :userId AND post_id = :postId ');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $hasliked = $statement->fetch(PDO::FETCH_ASSOC);

    return $hasliked;
}

function getFollowById(int $userId, int $chosenUserId, PDO $pdo){
    $statement=$pdo->prepare('SELECT * FROM follow WHERE user_id_0 = :userId AND user_id_1 = :chosenUserId ');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':chosenUserId', $chosenUserId, PDO::PARAM_INT);
    $statement->execute();
    $hasFollowed = $statement->fetch(PDO::FETCH_ASSOC);

    return $hasFollowed;
    
}