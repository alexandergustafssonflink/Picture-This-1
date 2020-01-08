<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
require __DIR__.'/../parse.php';

if (isset($_GET['id'], $_FILES['edit-post-image'])){
    //array storing name, type, tmp_name, error and size about uploaded file
    $newImage = $_FILES['edit-post-image'];
    $postId = (int) filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $post = getPostById($userId, $postId, $pdo);
    $imageId = $post['image_id'];
    $lastImage = $post['data'];

    if($_FILES['edit-post-image']['error'] === 0){
            //create a unique fileName, ends with type jpg or other
            $fileName = uniqid().($newImage['name']);
            $destination = __DIR__.'/uploads/images/'.$fileName;
            move_uploaded_file($newImage['tmp_name'], $destination);
            
            // Removes the previous image from the uploads folder
            if($newImage['name'] !== ''){
            unlink(__DIR__.'/uploads/images/'.$lastImage);
            }
                
            //update image data in image table
            $statement=$pdo->prepare("UPDATE image SET data = :filename WHERE id = :imageId");
            $statement->bindParam(':filename', $fileName, PDO::PARAM_STR);
            $statement->bindParam(':imageId', $imageId, PDO::PARAM_STR);
            $statement->execute();
        }
} 

if (isset($_GET['id'],$_POST['description'])){
    $description = $_POST['description'];
    //update description in post table
    $statement=$pdo->prepare("UPDATE post SET description = :description WHERE id = :postId");
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postId, PDO::PARAM_STR);
    $statement->execute();
}

$_SESSION['success'] = 'Your post was successfully updated';
redirect("/edit-post.php?id=".$postId);
