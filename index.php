<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!isset($_SESSION['user'])) : ?>
    <main class="welcome-container">
        <div class="title-group">
            <h1 class="title"><?php echo $config['title']; ?> </h1>
            <p>Sign up or login to see photos <br> from your friends.</p>
        </div>
        <div class="nav-button-wrapper">
            <a class="nav-button" href="/signup.php">Sign up</a>
            <a class="nav-button" href="/login.php">Login</a>
        </div> <!-- /welcome-container -->
    </main> <!-- /welcome-page -->

    <!-- If the user is logged in -->
<?php else : ?>
    <?php require __DIR__ . '/views/navigation.php'; ?>
    <?php require __DIR__ . '/app/parse.php'; ?>

    <?php if (isset($_SESSION['error'])) : ?>
        <p class="error-message"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <article class="feed">

        <?php if (!$posts) : ?>
            <div>
                <p class="no-post-message"> Oups, here is empty. <br> You can be the first to create a post!</p>
            </div>
        <?php endif; ?>

        <?php foreach ($posts as $post) :
            $likes = countLikes($post['id'], $pdo);
            $author = getUserById($post['user_id'], $pdo);
            $hasliked = getLikeRowById($userId, $post['id'], $pdo);
        ?>

            <div class="post-wrapper">

                <div class="post-info">
                    <form action="/profile.php" method="post">
                        <input type="hidden" name="author_id" value="<?php echo $author['id']; ?>">
                        <button type="submit" class="author-button"><span class="author"><?php echo $author['email'] ?></span></button>
                    </form>
                    <!-- check if user is the owner of post -->
                    <?php if ($post['user_id'] === $user['id']) : ?>
                        <a href="<?php echo "/edit-post.php?id=" . $post['id'] ?>" class="edit">Edit</a>
                    <?php endif; ?>
                </div> <!-- /post-info -->


                <img src="<?php echo "/app/posts/uploads/" . $post['data'] ?>" alt="post-image" class="img-in-feed" loading="lazy">

                <div class="like-row">
                    <?php if ($hasliked) : ?>
                        <form action="/app/posts/unlike.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <input type="image" src="/assets/icons/heart-unlike.png" alt="unlike-button" width="32px" height="32px" class="unlike-button"></input>
                        </form>
                    <?php else : ?>
                        <form action="/app/posts/like.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <input type="image" src="/assets/icons/heart-like.png" alt="like-button" width="32px" height="32px" class="like-button"></input>
                        </form>
                    <?php endif; ?>

                    <?php if ($likes === 1) : ?>
                        <p class="liked-by"><?php echo $likes; ?> like</p>
                    <?php elseif ($hasliked) : ?>
                        <p class="liked-by"><?php echo $likes; ?> likes</p>
                    <?php elseif (!$hasliked) : ?>
                        <p class="liked-by">Waiting for likes!</p>
                    <?php endif; ?>
                    <?php if ($post['description']) : ?>
                        <p class="description"><span class="author"><?php echo $author['email'] ?></span> <?php echo $post['description']; ?></p>
                    <?php endif; ?>
                </div> <!-- /like-row -->

                <ul class="commentList">

                    <?php $comments = getAllComments($post['id'], $pdo) ?>
                    <?php foreach ($comments as $comment) : ?>

                        <li class="commentRow">
                            <p class="commentAuthor"> <?php echo $comment['email'];  ?></p>
                            <p class="comment"> <?php echo $comment['comment']; ?> </p>
                            <?php if ($_SESSION['user']['id'] == $comment['user_id']) : ?>
                                <button class="editButton" type="submit">Edit</button>
                                <form class="updateForm hidden" action="">
                                    <input name="content" type="text">
                                    <input name="id" value="<?php echo $comment['id']; ?>" type="hidden">
                                    <button type="submit" class="updateComment">Update</button>
                                </form>
                                <button class="deleteButton" data-id="<?php echo $comment['id']; ?>"> Delete </button>
                            <?php endif; ?>

                        </li>




                    <?php endforeach;  ?>
                </ul>

                <!-- Comments section -->
                <!-- <form action="/app/comments/store.php?id=<?php echo $post['id']; ?>" class="commentsForm" method="post" enctype="multipart/form-data">
                    <label for="content"></label>
                    <textarea class="commentInput" name="comment" cols="30" rows="1" placeholder="Comment?"></textarea>
                    <button class="commentsButton" type="submit">Comment</button>
                </form> -->

                <form action="" class="commentsForm" method="post" enctype="multipart/form-data">
                    <label for="content"></label>
                    <input type="hidden" value="<?php echo $post['id']; ?>" name="postId">
                    <input type="hidden" value="<?php echo $_SESSION['user']['id']; ?>" name="userId">
                    <input type="hidden" value="<?php echo $_SESSION['user']['email']; ?>" name="userEmail">
                    <textarea class="commentInput" name="comment" cols="30" rows="1" placeholder="Comment?"></textarea>
                    <button class="commentsButton" type="submit">Comment</button>
                </form>

            </div> <!-- /post-wrapper -->

        <?php endforeach; ?>
        <!-- end foreachposts -->

    </article> <!-- /feed -->
<?php endif; ?>
<!-- endif loggedIn -->

<?php require __DIR__ . '/views/footer.php'; ?>