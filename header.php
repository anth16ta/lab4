<?php
    include "config.php"; 

    //Prevent session hijacking
    //if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']){
    //    session_unset();
    //    session_destroy();
    //}
    //End Prevent session hijacking
    
    ?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
    <title>Books</title>
</head>

<body>
    <div id="wrapper">
<header>
    <div id="headerimgbox">
        <img alt="header image, a book" src="img/headerimg.jpg" 
    </div>
    <h1>Books.</h1>
    <nav>
        <ul>
            <li>
                <a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php">Home</a>
            </li>
            <li>
                <a class="<?php echo ($current_page == 'about.php') ? 'active' : NULL ?>" href="about.php">About us</a>
            </li>
            <li>
                <a class="<?php echo ($current_page == 'browse.php') ? 'active' : NULL ?>" href="browse.php">Browse books</a>
            </li>
            <li>
                <a class="<?php echo ($current_page == 'mybooks.php') ? 'active' : NULL ?>" href="mybooks.php">My books</a>
            </li>
            <li>
                <a class="<?php echo ($current_page == 'gallery.php') ? 'active' : NULL ?>" href="gallery.php">Gallery</a>
            </li>
            <li>
                <a class="<?php echo ($current_page == 'contact.php') ? 'active' : NULL ?>" href="contact.php">Contact</a>
            </li>
        </ul>
    </nav>
</header>