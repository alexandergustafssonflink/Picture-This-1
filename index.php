<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Welcome to flowergram</p>

</article>

<?php if(isset($_SESSION['user'])):?>
    <?php require __DIR__.'/app/parse.php'; ?>
    <p><?php echo 'You are signed in ' . $_SESSION['user']['email']; ?></p>

        <article class="feed">

            <?php foreach ($posts as $post): ?>
            <?php $likes = countLikes($post['id'],$pdo) ?>

                <div class= "post-wrapper">
                    <div class ="post-content">
                        <img src="<?php echo '/app/posts/uploads/images/'.$post['data']?>" alt="post-image">
                        <p><?php echo $post['description']; ?></p>
                    </div> <!-- /post-content -->

                    <form action="/app/posts/like.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                        <button type="submit">Like</button>
                    </form>

                    <form action="/app/posts/unlike.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                        <button type="submit">Unlike</button>
                    </form>

                    <!-- check if user is the owner of post -->
                    <?php if ($post['user_id'] === $user['id']): ?> 
                        <a href="<?php echo "/edit-post.php?id=".$post['id']?>">Edit post</a>
                    <?php endif; ?>

                    <div class= likes>
                        <p>Liked by <?php echo $likes; ?> flowerpowers.</p>
                    </div>

                </div> <!-- /post -->

            <?php endforeach; ?> <!-- end post -->

        </article> <!-- /feed -->
<?php endif; ?> <!-- endif loggedIn -->

<?php require __DIR__.'/views/footer.php'; ?>
