<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php if(isset($_SESSION['user'])):?>
    <?php require __DIR__.'/app/parse.php'; ?>
    <p><?php echo 'You are signed in ' . $_SESSION['user']['email']; ?></p>

      <article class="feed">
        <?php foreach ($posts as $post): ?>
            <div class= "post">
                <img src="<?php echo '/app/posts/uploads/images/'.$post['data']?>" alt="post-image">
                <p><?php echo $post['description']; ?></p>
            <!-- check if user is the owner of post -->
            <?php if ($post['user_id'] === $user['id']): ?> 
                <a href="<?php echo "/edit-post.php?id=".$post['id']?>">Edit post</a>
            <?php endif; ?>
            </div> <!-- /post -->
        <?php endforeach; ?> <!-- end post -->
      </article> <!-- /feed -->
<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
