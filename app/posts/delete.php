<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
require __DIR__.'/../parse.php';

if(isset($_POST['password'])){
    $email = $user['email'];
    $statement = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user=$statement->fetch(PDO::FETCH_ASSOC);
    
    $postId = (int) filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post = getPostById($userId, $postId, $pdo);
    $imageId = $post['image_id'];
    $lastImage = $post['data'];

    if (!$user) {
        redirect('/');
    } 
    if(password_verify($_POST['password'], $user['password'])) {
    // Removes the previous image from the uploads folder
    unlink(__DIR__.'/uploads/images/'.$lastImage);
        
    //delete image row
    $statement=$pdo->prepare("DELETE FROM image WHERE id = :imageId");
    $statement->bindParam(':imageId', $imageId, PDO::PARAM_STR);
    $statement->execute();

    //delete post row
    $statement=$pdo->prepare("DELETE FROM post WHERE id = :postId");
    $statement->bindParam(':postId', $postId, PDO::PARAM_STR);
    $statement->execute();

    } else {
        $_SESSION['error'] = 'The password is not correct!';
        redirect("/edit-post.php?id=".$postId);  
    }
} 
redirect('/');