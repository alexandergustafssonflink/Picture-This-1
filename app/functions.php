<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

function getPostById(int $userId, int $postId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM post INNER JOIN image ON image_id = image.id WHERE user_id = :userid AND post.id = :postid');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userid', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postid', $postId, PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetch(PDO::FETCH_ASSOC);

    if ($post) {
        return $post;
    }
}


function getAvatarbyId(int $imageId, PDO $pdo)
{
    $statement = $pdo->prepare("SELECT data FROM user INNER JOIN image ON user.image_id = image.id WHERE image.id = :imageId");
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':imageId', $imageId, PDO::PARAM_INT);
    $statement->execute();
    $avatar = $statement->fetch(PDO::FETCH_ASSOC);
    if ($avatar) {
        return $avatar;
    }
}

function getUserById(int $userId, PDO $pdo): array
{
    $statement = $pdo->prepare('SELECT * FROM user WHERE id = :userId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $author = $statement->fetch(PDO::FETCH_ASSOC);

    if ($author) {
        return $author;
    }
}

function countLikes(int $postId, PDO $pdo): int
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM like WHERE post_id = :postId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $likes = $statement->fetch(PDO::FETCH_ASSOC);

    return (int) $likes['COUNT(*)'];
}

function getLikeRowById(int $userId, int $postId, PDO $pdo)
{
    $statement = $pdo->prepare('SELECT * FROM like WHERE user_id = :userId AND post_id = :postId ');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $hasliked = $statement->fetch(PDO::FETCH_ASSOC);

    return $hasliked;
}

function countFollowers(int $chosenUserId, PDO $pdo): int
{
    $statement = $pdo->prepare('SELECT COUNT(*) FROM follow WHERE user_id_1 = :userId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $chosenUserId, PDO::PARAM_INT);
    $statement->execute();
    $followers = $statement->fetch(PDO::FETCH_ASSOC);

    return (int) $followers['COUNT(*)'];
}

function getFollowById(int $userId, int $chosenUserId, PDO $pdo)
{
    $statement = $pdo->prepare('SELECT * FROM follow WHERE user_id_0 = :userId AND user_id_1 = :chosenUserId ');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':chosenUserId', $chosenUserId, PDO::PARAM_INT);
    $statement->execute();
    $hasFollowed = $statement->fetch(PDO::FETCH_ASSOC);

    return $hasFollowed;
}


function getAllComments(int $postId, pdo $pdo)
{
    $statement = $pdo->prepare('SELECT comment.*, user.email FROM comment INNER JOIN user ON comment.user_id = user.id WHERE post_id = :postId ORDER BY date');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}


function getSearchResult(string $searchTerm, pdo $pdo)
{
    $sql = "SELECT * FROM user WHERE email LIKE :searchTerm";

    $statement = $pdo->prepare($sql);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $searchTerm = "%" . $searchTerm . "%";

    $statement->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);

    $statement->execute();

    $searchResult = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($searchResult == false) {
        return false;
    } else {
        return $searchResult;
    }
}

function getAllPostsByUser(int $userId, pdo $pdo)
{
    $statement = $pdo->prepare('SELECT * FROM post INNER JOIN user ON post.user_id = user.id INNER JOIN image ON post.image_id = image.id WHERE post.user_id = :userId');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($posts) {
        return $posts;
    }
}
