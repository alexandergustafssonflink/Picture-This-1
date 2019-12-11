<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we signup users.

if(!isset($_POST['email'], $_POST['password'])){
    return $errors[]= 'Please fill both the username and password field!';
}

if($statement=$pdo->prepare('SELECT id, password FROM users WHERE email = ?')){
    $statement->bindParam('s', $_POST['email'], PDO::PARAM_STR_CHAR);
    $statement->execute();
} 