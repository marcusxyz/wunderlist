<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


$errors = [];

if (isset($_POST['submit'])) {
    echo 'WOOOH! It works';
} else {
    echo "<script>alert('Not working')</script>";
}

// header('Location: /index.php');


// redirect('/login.php');
