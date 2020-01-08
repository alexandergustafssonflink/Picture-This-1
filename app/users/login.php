<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(isset($_POST['email'], $_POST['password'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        $statement = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        
        $user=$statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $_SESSION['error'] = "Sorry, your password was incorrect.";
            redirect('/../../login.php');   
        }

        if (password_verify($_POST['password'], $user['password'])) {
            //password_verify verifies typed password against hashed password from database and returns a bool. 
            
            unset($user['password']);
            
            $_SESSION['user'] = $user;
            
            redirect('/');
        } 

    } else {
        $_SESSION['error'] = "The email address is not valid.";
        redirect('/../../login.php');   
    }
}
