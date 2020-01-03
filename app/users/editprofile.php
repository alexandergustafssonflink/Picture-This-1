<?php
declare(strict_types=1);


require __DIR__.'/../autoload.php';
require __DIR__.'/../parse.php';


if (isset($_POST['email'])){
    $statement=$pdo->prepare("UPDATE user SET email = :email WHERE id = :id");
    $statement->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->execute();
    
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    
    //We also need to save the updated email in cookies which is updated in the database.
    //Using parse.php to fetch the users information stored in variable $user.
    
    $_SESSION['user']['email'] = $user['email'];
} 

//having an issue that isset($_POST['password']) evalutes True even if it's empty therefore password is required. 
if (isset($_POST['password']) && $_POST['password'] === $_POST['password-repeat'] ) {
    $statement=$pdo->prepare("UPDATE user SET password = :pwd WHERE id = :id");
    $hashedPwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->execute();

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
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
