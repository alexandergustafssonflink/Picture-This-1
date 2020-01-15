<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';


if($_SESSION['user'] && isset($_FILES['profile-img'])){
    if($_FILES['profile-img']['error'] === 0){
        //array storing name type tmp_name error and size about uploaded file
        $avatar = $_FILES['profile-img'];
        $id = $_SESSION['user']['id'];
        //create a unique fileName, ends with type jpg or other
        $fileName = uniqid().($avatar['name']);
        $destination = __DIR__.'/uploads/'.$fileName;
                
        // Using the move_uploaded_file function we can upload files from the
        // temporary path to a new destination. Remember to specify the full
        // path to where PHP should save the file on your system.
        move_uploaded_file($avatar['tmp_name'], $destination);
                
        //insert avatar to image table
        $statement=$pdo->prepare("INSERT INTO image (data) VALUES (:filename)");
        $statement->bindParam(':filename', $fileName, PDO::PARAM_STR);
        $statement->execute();
                
        //fetch the latest inserted image
        $stmnt=$pdo->prepare("SELECT * FROM image ORDER BY ID DESC LIMIT 1");
        $stmnt->execute();
        $image=$stmnt->fetch(PDO::FETCH_ASSOC);
                
        //update user.image_id 
        $statement=$pdo->prepare("UPDATE user SET image_id = :imageid WHERE id = :id");
        $statement->bindParam(':imageid', $image['id'], PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
    }

    else if($_FILES['profile-img']['error'] === 1){
        $_SESSION['error'] = "The file is to big to upload.";
        redirect('/../../myaccount.php');
        
    }

    else if($_FILES['profile-img']['error'] === 4){
        $_SESSION['error'] = "You didn't choose a file before upload.";
        redirect('/../../myaccount.php');
    }
}
redirect('/../../myaccount.php');
