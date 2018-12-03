<?php

require_once 'conf/config.php';

// Controllers
require_once  'controllers/CartController.php';

// Get the URL to use in other places
$whole_url = parse_url($_SERVER['REQUEST_URI']);
$url = $whole_url['path'];
$url_parts = explode('/', $url);
if(isset($whole_url['query'])) {
    $arguments = explode('/', $whole_url['query']);
}

$request = $_SERVER['REQUEST_URI'];

session_start();

// Standaar error variable maken zodat we deze overal kunnen overschrijven met een error message indien nodig
$error = null;

?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">     
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="media/css/style.css">
    </head>
    <body>
    <?php
    include 'views/header.php';

    switch($url) {
        case $default_url:
            require __DIR__ . '/views/homepage.php';
            break;
        case $default_url . 'home':
            require __DIR__ . '/views/homepage.php';
            break;
        case $default_url . 'category':
            require __DIR__ . '/views/category.php';
            break;
        case $default_url . 'product':
            require __DIR__. '/views/product.php';
            break;
        case $default_url . 'cart':
            require __DIR__ . '/views/cart.php';
            break;
        case $default_url . "search":
            require 'views/search.php';
            break;
        case $default_url . "about":
            require "views/about.php";
            break;
        case $default_url . 'confirm':
            require __DIR__ . '/views/orderpage_items.php';
            break;
        case $default_url . 'method':
            require __DIR__ . '/views/orderpage_method_consumer.php';
            break;
        case $default_url . 'method_visitor':
            require __DIR__ . '/views/orderpage_method_visitor.php';
            break;
        case $default_url . 'login':
            require __DIR__ . '/views/registratie.php';
            break;
        default:
            print('hek nie');
            break;
    }
include 'views/footer.php';
?>