<?php
// IN HERE WE STORE COMMENTS
declare(strict_types=1);

require __DIR__ . '/../autoload.php';



$user = $_SESSION['user'];
$id = $user['id'];
$date = date('Y/m/d h:i:s a', time());


if (isset($_POST['comment'], $_POST['postId'], $_POST['userId'], $_POST['userEmail'])) {
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $postid = $_POST['postId'];
    $userId = $_POST['userId'];
    $userEmail = $_POST['userEmail'];
    $id = uniqid();


    $sql = 'INSERT INTO comment (post_id, comment, user_id, date) VALUES (:postId, :comment, :userId, :date)';

    $statement = $pdo->prepare($sql);
    if (!$statement) {
        $errors = $pdo->errorInfo();
        echo json_encode($errors);
        exit;
    }

    $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
    $statement->bindParam('userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postid, PDO::PARAM_STR);

    $statement->execute();

    $id = $pdo->lastInsertId();

    $response = [
        'comment' => $comment,
        'userId' => $user,
        'userEmail' => $userEmail,
        'date' => $date,
        'id' => $id
    ];

    echo json_encode($response);
    exit;
}
