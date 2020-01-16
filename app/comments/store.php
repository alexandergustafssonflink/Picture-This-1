<?php
// IN HERE WE STORE COMMENTS
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$user = $_SESSION['user'];
$id = $user['id'];
$date = date('Y/m/d h:i:s a', time());

if (isset($_POST['comment'])) {
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
    $postid = $_GET['id'];

    $sql = 'INSERT INTO comment (post_id, comment, user_id, date) VALUES (:postId, :comment, :id, :date)';

    $statement = $pdo->prepare($sql);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->bindParam(':postId', $postid, PDO::PARAM_STR);

    $statement->execute();

    redirect('/');
}
