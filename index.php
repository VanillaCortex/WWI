<?php

require_once 'config.php';

$sql = "SELECT * FROM people;";
$result = $mysqli->query($sql)->fetch_all();

foreach($result as $key => $item) {
    print_r($item);
}

//print_r($result['FullName']);

//$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
//
//switch ($request_uri[0]) {
//    // About page
//    case '/about':
//        require '../views/about.php';
//        break;
//    // Everything else
//    default:
//        header('HTTP/1.0 404 Not Found');
//        require '../views/404.php';
//        break;
//}