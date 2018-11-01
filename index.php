<?php

require_once 'conf/config.php';

//$sql = "SELECT * FROM people;";
//$result = $mysqli->query($sql)->fetch_all();

//foreach($result as $key => $item) {
//    print_r($item);
//}

//print_r($result['FullName']);

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

//$url = parse_url($request_uri[0]);
//print_r($url);
//if(strpos($request_uri[0], '/category/')) {
//    $url = parse_url($request_uri[0]);
//    $array = [];
//    $parsed_url = parse_str($url['path'], $array);
//    print_r($array);
//}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="media/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
    <script>
            
    </script>
        <?php
        // Header
        require_once 'views/header.php';
        ?>

        <div class="col-md-10 offset-md-1">
            <?php
            switch ($request_uri[0]) {
                // Home page
                case '/WWI/':
                    require 'views/homepage.php';
                    break;
                case '/WWI/category/':
                    require 'views/category.php';
                    break;
                // Default (404)
                default:
//                    header('HTTP/1.0 404 Not found');
            }
            ?>
        </div>

    </body>

</html>

<?