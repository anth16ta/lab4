<?php
$uri = $_SERVER['REQUEST_URI'];
$uri_array = explode("/", $uri);
$current_page = end($uri_array);

$dbserver = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "LabBooks";
?>