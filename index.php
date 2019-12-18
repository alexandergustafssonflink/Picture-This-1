<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php if(isset($_SESSION['user'])){
      echo 'You are signed in ' . $_SESSION['user']['email'];
    }?>

<?php require __DIR__.'/views/footer.php'; ?>
