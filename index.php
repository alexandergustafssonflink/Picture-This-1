<?php require __DIR__.'/views/header.php'; ?>

<?php if(!isset($_SESSION['user'])):?>
    <main class="welcome-container">
        <div class= "title-group"> 
            <h1 class="title"><?php echo $config['title']; ?> </h1>
            <p>Sign up or login to see photos <br> from your friends.</p>
        </div>
        <div class="nav-button-wrapper">
            <a class="nav-button" href="/signup.php">Sign up</a>
            <a class="nav-button" href="/login.php">Login</a>
        </div> <!-- /welcome-container -->
    </main> <!-- /welcome-page -->

<?php else : ?> 
    <?php require __DIR__.'/views/navigation.php'; ?>
    <?php require __DIR__.'/app/parse.php'; ?>
        <nav class= "nav-top">
            <h1 class="title"><?php echo $config['title']; ?> </h1>
        </nav>

        <article class="feed">
            <?php foreach ($posts as $post): 
            $likes = countLikes($post['id'],$pdo);
            $author = getUserById($post['user_id'], $pdo);
            ?>

            <div class= "post-wrapper">
                <div class ="post-content">
                    <div class="post-info">
                        <form action="/profile.php" method="post">
                            <input type="hidden" name="author_id" value="<?php echo $author['id'];?>">
                            <button type="submit" class="author"><?php echo $author['email']?></button>
                        </form>
                        <!-- check if user is the owner of post -->
                        <?php if ($post['user_id'] === $user['id']): ?> 
                            <a href="<?php echo "/edit-post.php?id=".$post['id']?>" class="edit">Edit post</a>
                        <?php endif; ?>
                    </div> <!-- /post-info -->
    
                    <img src="<?php echo '/app/posts/uploads/images/'.$post['data']?>" alt="post-image">
                    
                    <div class= "like-row">
                        <p class= "liked-by">Liked by <?php echo $likes; ?></p>
                        <form action="/app/posts/like.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                            <button type="submit" class="like-button" ><img src="/assets/icons/heart-like.png" alt="heart"></button>
                        </form>
    
                        <form action="/app/posts/unlike.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id'];?>">
                            <button type="submit" class="unlike-button"><img src="/assets/icons/heart-unlike.png" alt="heart"></button>
                        </form>
                    </div><!-- /like-row -->

                    <p class= "description"><?php echo $author['email']?> says: <?php echo $post['description']; ?></p>
                </div> <!-- /post-content -->


            </div> <!-- /post-wrapper -->

            <?php endforeach; ?> <!-- end foreachposts -->

        </article> <!-- /feed -->
<?php endif; ?> <!-- endif loggedIn -->

<?php require __DIR__.'/views/footer.php'; ?>