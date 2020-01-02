<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(isset($_FILES['post-img'])){
    if($_FILES['post-img']['size'] < 3145728){
    //array storing name, type, tmp_name, error and size about uploaded file
    $postImage = $_FILES['post-img'];
    $id = $_SESSION['user']['id'];

    //create a unique fileName, ends with type jpg or other
    $fileName = uniqid().($postImage['name']);
    $destination = __DIR__.'/uploads/images/'.$fileName;
        
    // Using the move_uploaded_file function we can upload files from the
    // temporary path to a new destination. Remember to specify the full
    // path to where PHP should save the file on your system.
    move_uploaded_file($postImage['tmp_name'], $destination);
        
    //insert image to image table
    $statement=$pdo->prepare("INSERT INTO image (data) VALUES (:filename)");
    $statement->bindParam(':filename', $fileName, PDO::PARAM_STR);
    $statement->execute();
        
        //fetch the latest inserted image
        $stmnt=$pdo->prepare("SELECT * FROM image ORDER BY ID DESC LIMIT 1");
        $stmnt->execute();
        $image=$stmnt->fetch(PDO::FETCH_ASSOC);

        //insert data to post table
        if(isset($_POST['description'])){
            $statement=$pdo->prepare("INSERT INTO post (user_id, image_id, description) VALUES (:userid, :imageid, :description)");
            $statement->bindParam(':userid', $id, PDO::PARAM_STR);
            $statement->bindParam(':imageid', $image['id'], PDO::PARAM_STR);
            $statement->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
            $statement->execute();

        }


    redirect('/create-post.php');
    }
}


