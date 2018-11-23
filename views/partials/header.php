<?php
// Get all the catergories
$query = '
    SELECT StockGroupID, StockGroupName
    FROM stockgroups ';
$items = $pdo->prepare($query);
$items->execute();
$q = filter_input(INPUT_GET, "q", FILTER_SANITIZE_STRING);
?>

<html>
<head>
    <title>Wide World Importers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="media/css/style.css">
    <style>
        .navul{
            display: flex;
            align-items: stretch; /* Default */
            justify-content: space-between;
            width: 100%;
            background: ;
            margin: 0;
            padding: 0;
        }
        .navli{
            color: black;
            display: block;
            flex: 0 1 auto; /* Default */
            list-style-type: none;
            background: ;
        }
    </style>
</head>
<body>
<div class="fixed-top">
    <nav class="navbar  navbar-dark bg-dark justify-content-between">
        <div class="container">
            <a  class="nav-left" href="/WWI/">
                <img src="media/images/logo.png"  style="width: 177px;">
            </a>
            <form class="form-inline " action="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="q">
                <!--                    <button class="btn btn-outline-default my-2 my-sm-0" type="submit">Search</button>
                -->                </form>
            <a class="nav-right" href="cart" >
                <i class="fas fa-shopping-basket fa-2x"></i>
            </a>
        </div>
    </nav>
    <nav class="navbar navbar-light bg-light justify-content-between">
        <div class="container">
            <ul class="navul">
                <?php
                while ($item = $items->fetch()){
                    if($item['StockGroupID'] !=5){
                        ?>
                        <!--Print hier de namen van categorien-->
                        <li class="navli">
                            <a href="category?<?= $item['StockGroupID'] ?>"><?= $item['StockGroupName'] ?></a>
                        </li>

                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </nav>
</div>

<!-- Tijdelijke opslag oude header -->
<div class="col-md-10 offset-md-1">
    <nav class="navbar">
        <a class="navbar-brand" href="/WWI/">
            <img src="media/images/logo.png" width="177" height="64">
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <h4>World Wide Importers</h4>
            </li>
        </ul>
    </nav>
</div>