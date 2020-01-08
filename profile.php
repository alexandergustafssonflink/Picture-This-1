<?php require __DIR__.'/views/header.php'; 

if (!isset($_SESSION['user'])){
    redirect('/');
} else {
    require __DIR__.'/app/parse.php';
    require __DIR__.'/views/navigation.php'; 
}
?>
<nav class= "nav-top">
    <h1 class="title"><?php echo $config['title']; ?> </h1>
</nav>

<?php if(isset($_POST['author_id'])): ?>
    <?php 
    $userId = (int) $user['id'];
    $chosenUserId = (int) filter_var($_POST['author_id'], FILTER_SANITIZE_NUMBER_INT); 
    $chosenUser = getUserById($chosenUserId, $pdo);
    $imageId = $chosenUser['image_id'];

    /* if the user has an avatar the imageId has an int */
    if($imageId) {
        $avatar = getAvatarbyId($imageId, $pdo);
    }
    $followers = countFollowers($chosenUserId, $pdo);
    $hasFollowed = getFollowById($userId, $chosenUserId, $pdo)

    ?>
    <div class="profile-wrapper">
        <div class="profile-content">
            <?php if($imageId): ?>
            <img src="<?php echo "/app/users/uploads/avatars/".$avatar['data'];?>" alt="avatar-image" class="avatar" loading="lazy">
            <?php endif; ?>
            <p><?php echo $chosenUser['email']; ?></p>
            <p>Followed by <?php echo $followers ; ?>.</p>
            <p><?php echo $chosenUser['biography']; ?></p>
        </div> <!-- /profile-content  -->


        <div class="follow-buttons-wrapper">
            <?php if ($hasFollowed): ?>
                <form action="/app/follow/unfollow.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $chosenUserId ;?>">
                <input type="submit" value="Unfollow" class="follow-buttons"></input>
            </form>
            <?php else: ?>
                <form action="/app/follow/follow.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $chosenUserId ;?>">
                    <input type="submit" value="Follow" class="follow-buttons"></input>
                </form>
            <?php endif; ?>
            
        </div> <!-- follow-buttons-wrapper -->
    </div> <!-- /profile-wrapper -->

<?php endif ;?>


<?php require __DIR__.'/views/footer.php'; ?>
