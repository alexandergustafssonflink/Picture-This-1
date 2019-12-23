<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if(isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $statement = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    
    $user=$statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        redirect('/login.php');
    }

    if (password_verify($_POST['password'], $user['password'])) {
        //password_verify verifies typed password against hashed password from database and returns a bool. 
        
        unset($user['password']);
        
        $_SESSION['user'] = $user;
        
        redirect('/');
    }else {
        redirect('/login.php');
    }
}
