<?php
declare(strict_types=1);


require __DIR__.'/../autoload.php';
require __DIR__.'/../parse.php';


if (isset($_POST['email'])){
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    if(filter_var($email , FILTER_VALIDATE_EMAIL)){
    $statement=$pdo->prepare("UPDATE user SET email = :email WHERE id = :id");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->execute();
    
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    
    //Save the updated email in cookies which value is updated in the database.
    //Using parse.php to fetch the users information stored in variable $user.
    
    $_SESSION['user']['email'] = $user['email'];    
    } else {
        $_SESSION['error'] = "The email address is not valid.";
    } 
}

//had an issue that isset($_POST['password']) evalutes True even if it's a empty string therefore password was required.
    //One solution is to use not empty
if (isset($_POST['password']) && !empty($_POST['password'])) {
    if($_POST['password'] === $_POST['password-repeat']) {
    $statement=$pdo->prepare("UPDATE user SET password = :pwd WHERE id = :id");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->execute();

    } else {
        $_SESSION['error'] = "The passwords are not matching.";
        redirect('/../../account.php');
    }
} 

if (isset($_POST['biography'])){
    $statement=$pdo->prepare("UPDATE user SET biography = :bio WHERE id = :id");
    $statement->bindParam(':bio', $_POST['biography'], PDO::PARAM_STR);
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->execute();
    
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    
    $_SESSION['user']['biography'] = $user['biography']; 
}

redirect('/account.php');
