<?php

declare(strict_types=1);

$statement = $pdo->prepare('SELECT * FROM user WHERE email = :email');
$statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
$statement->execute();
    
$user=$statement->fetch(PDO::FETCH_ASSOC);

