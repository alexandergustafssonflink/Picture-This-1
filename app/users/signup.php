<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we signup users.

if (isset($_POST['email'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($_POST['password']===$_POST['password-repeat']) {
            $statement=$pdo->prepare("INSERT INTO user (password, email) VALUES (:pwd, :email)");
            $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $statement->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
            $statement->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $statement->execute();

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            redirect('/login.php');
        } else {
            $_SESSION['error'] = "The passwords are not matching.";
            redirect('/../../signup.php');
        }
    } else {
        $_SESSION['error'] = "The email address is not valid.";
        redirect('/../../signup.php');
    }
}
