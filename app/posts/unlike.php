<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
require __DIR__.'/../parse.php';

if(isset($_POST['post_id'])){
    $userId = (int) $_SESSION['user']['id'];
    $postId = (int) filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    
    $statement=$pdo->prepare("SELECT * FROM like WHERE user_id = :userId AND post_id = :postId");
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->execute();
    
    $liked = $statement->fetch(PDO::FETCH_ASSOC);
    
    if($liked){
        $statement=$pdo->prepare("DELETE FROM like WHERE user_id = :userId AND post_id = :postId");
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
        $statement->execute();
    }
    
    $likes = countLikes($postId, $pdo);
}
redirect('/');