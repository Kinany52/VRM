<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$controller = match ($_SERVER['REQUEST_URI'])
{
    '/' => function() {
        header("Location: files/homepage.php");
    }
};
$controller(); 