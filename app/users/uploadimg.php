<?php
declare(strict_types=1);


require __DIR__.'/../autoload.php';

if(isset($_POST['profile-img'])){
    die(var_dump('hello'));
}

redirect('/profile.php');