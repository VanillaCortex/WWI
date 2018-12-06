<?php
if(isset($arguments)) {
    if(isset($arguments[0])) {
        $product_id = $arguments[0];
    }
} else {
    print('Oops! Er ging iets mis. Probeer terug te gaan naar de vorige pagina');
    die;
}

// Get the product we want
$query = "
SELECT s.StockItemID, s.StockItemName, s.RecommendedRetailPrice, s.MarketingComments, sih.QuantityOnHand
FROM stockitems s
JOIN stockitemholdings sih ON s.StockItemID = sih.StockItemID
WHERE s.StockItemID = ?";
$product = $pdo->prepare($query);
$product->execute(array($product_id));
$product = $product->fetch();

    $error = '<br><br>';

    // Als de url error bevat
    if(array_search('error', $arguments) !== false) {
        $error = '<div class="alert alert-danger" role="alert">Moet minimaal 1 product bestellen!</div>';
    }

    // Als de url success bevat
    if(array_search('success', $arguments) !== false) {
        $error = '<div class="alert alert-success" role="alert">Product is toegevoegd!</div>';
    }
?>
    <div style="padding-top: 15px" class="container">
        <div class="row">
            <!--Naam van het product-->
            <div class="col-sm-12">
                <br><br><br>
            </div>

            <div class="col-md-6">
                <?php include 'partials/carousel.php'; ?>
            </div>

            <!--Prijsnotering-->
            <div class="col-md-6">
                <h3 class="head"><?= $product['StockItemName'] ?></h3>
                <br><br>
                <h4>Prijs per Stuk:</h4>
                <h2 class="blackFriday">€ <?= round($product['RecommendedRetailPrice']*1.2, 2)  ?></h2>
                <h2 class="price">€ <?= $product['RecommendedRetailPrice']  ?></h2>

                <?= $error ?>

                <h6>Vooraad: </h6><div><?=$product['QuantityOnHand']?></div>
                <form method="post">
                    <input class="form-control" type="number" name="aantal" min="1" max="<?=$product['QuantityOnHand']?>" value="1">
                    <input class="hidden" name="product" type="number" value="<?=$product['StockItemID']?>">
                    <br>
                    <button class="float-right btn btn-success" type="submit">Toevoegen aan winkelwagen</button>
                </form>
            <button onclick="window.history.back()" class="btn btn-default">Terug</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h5>Beschrijving:</h5>

                <?php
                if(!empty($product['MarketingComments'])) {
                    print($product['MarketingComments']);
                } else{
                    // Nog niks doen hier
                }
                ?>
            </div>
            <div class="col-md-6">
                <h5>Reviews:</h5>
            </div>
        </div>
    </div>
<?php

if(isset($_POST) && !empty($_POST)) {

    $aantal = $_POST['aantal'];
    $product = $_POST['product'];

    if(empty($aantal)) {
        // Refresh de pagina met een error
        echo '<script>window.location.replace("/WWI/product?' . $product_id . '/error");</script>';
        die;
    }

    // Initialize the class
    $cart = new Cart();

    // Add item to cart
    $item = $cart->addItemToCart($aantal, $product);

    // Refresh de pagina met een success bericht
    echo '<script>window.location.replace("/WWI/product?' . $product_id . '/success");</script>';

}
?>