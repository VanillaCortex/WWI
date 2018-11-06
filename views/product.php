<?php
require_once '../conf/config.php';
// Check if the GET was succsesfull
if(!isset($_GET) && !isset($_GET['product'])) {
    print('Oops! Something went wrong. Try and return to the previous page');
    die;
}

// Get the product ID from the GET
$product_id = $_GET['product'];

// Get the request_uri
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Get the product we want
$query = "
SELECT *, sih.QuantityOnHand
FROM stockitems s
JOIN stockitemholdings sih ON s.StockItemID = sih.StockItemID
WHERE s.StockItemID = ?";
$product = $pdo->prepare($query);
$product->execute(array($product_id));
$product = $product->fetch();

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../media/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../media/javascript/jquery.js" type="text/javascript"></script>
    </head>
    <?php
    // Header
    require_once 'header.php';
    ?>
    <div class="col-md-10 offset-md-1">
        <div class="row custom-container">
            <div class="col-sm-12">
                <h1><?=$product['StockItemName']?></h1>
            </div>

            <div class="col-sm-7">
                <div class="nice-box">
<!--                    <img src="--><?//=$product['Photo']?><!--">-->
                    <img src="../media/images/no_image.jpg" width="50%">
                </div>
            </div>

            <div class="col-sm-5">
                <div class="nice-box">
                    <h3>€<?=$product['RecommendedRetailPrice']?></h3>
                    <!--Winkelwagen doen we met Ajax waarschijnlijk-->
                    <input type="number" min="1" max="<?=$product['QuantityOnHand']?>" value="1">
                    <button>Toevoegen aan winkelwagen</button>
                    <p><?php if($product['QuantityOnHand'] > 0) { echo 'Product is op voorraad'; } else { echo 'Product is niet op voorraad'; } ?></p>
                    <p><b>Voorraad:</b>  <?=$product['QuantityOnHand']?> </p>
                </div>
            </div>

            <div class="col-sm-7">
                <div class="nice-box">
                    <p><b>Beschrijving</b></p>
                    <?php
                    if(!empty($product['MarketingComments'])) {
                        print($product['MarketingComments']);
                    } else {
                        print('geen beschrijving');
                    }
                    ?>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="nice-box">
                    <p><b>Comments</b></p>
                </div>
            </div>

        </div>