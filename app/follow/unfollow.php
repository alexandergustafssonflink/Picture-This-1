<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';
require __DIR__.'/../parse.php';

if (isset($_POST['user_id'])) {
    $userId = (int) $_SESSION['user']['id'];
    $chosenUserId = (int) filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);

    if ($userId !== $chosenUserId) {
        $statement=$pdo->prepare("SELECT * FROM follow WHERE user_id_0 = :userId AND user_id_1 = :chosenUserId");
        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->bindParam(':chosenUserId', $chosenUserId, PDO::PARAM_INT);
        $statement->execute();
        
        $followed = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($followed) {
            $statement=$pdo->prepare("DELETE FROM follow WHERE user_id_0 = :userId AND user_id_1 = :chosenUserId");
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->bindParam(':chosenUserId', $chosenUserId, PDO::PARAM_INT);
            $statement->execute();
        }
    }
    
    
    // $followers = countFollowers($userId, $pdo);
}
redirect('/');
