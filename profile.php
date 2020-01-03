<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/app/parse.php';
}
?>
<?php if(isset($_POST['author_id'])): ?>
    <?php 
    $chosenUserId = (int) filter_var($_POST['author_id'], FILTER_SANITIZE_NUMBER_INT); 
    $chosenUser = getUserById($chosenUserId, $pdo);
    $imageId = $chosenUser['image_id'];
    $avatar = getAvatarbyId($imageId, $pdo);
    $followers = countFollowers($chosenUserId, $pdo);
    ?>

    <p><?php echo $chosenUser['email']; ?></p>
    <img src="<?php echo "/app/users/uploads/avatars/".$avatar['data'];?>" alt="avatar-image">
    <p>Followed by <?php echo $followers ; ?> flowerpowers.</p>
    <p><?php echo $chosenUser['biography']; ?></p>

    <form action="/app/follow/follow.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $chosenUserId ;?>">
        <button type="submit">Follow</button>
    </form>
    <form action="/app/follow/unfollow.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $chosenUserId ;?>">
        <button type="submit">Unfollow</button>
    </form>

<?php endif ;?>

<?php require __DIR__.'/views/footer.php'; ?>
