<?php
require_once '../conf/config.php';
// Check if the get was succesfull and if the desired value is present
if(!isset($_GET) && !isset($_GET['category'])) {
    die;
}
// Get the category from the GET
$category = $_GET['category'];

// Get the url to do stuff with
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Get the products of our Category
$query = "
SELECT s.* 
FROM stockitems s 
WHERE s.StockItemID 
IN(
SELECT b.StockItemId 
FROM stockitemstockgroups b 
WHERE b.StockGroupID = ?) ";
$products = $pdo->prepare($query);
$products->execute(array($category));

$query = "
SELECT StockGroupName
FROM stockgroups
WHERE StockGroupID = ?";
$this_category = $pdo->prepare($query);
$this_category->execute(array($category));
$this_category = $this_category->fetch();

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../media/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <?php
    // Header
    require_once 'header.php';
    ?>
    <div class="col-md-10 offset-md-1">
        <div class="row custom-container">

            <div class="col-sm-12">
                <div class="nice-box">
                    <h3><?= $this_category['StockGroupName'] ?></h3>
                </div>
            </div>

            <?php
            while($product = $products->fetch()) {

                ?>
                <div class="col-sm-3">
                    <div class="nice-box clickable">
                        <p><b><?= $product['StockItemName'] ?></b></p>
                        <?=$product['Photo']?>
                        <img src="../media/images/logo.png" width="100%">
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</html>
