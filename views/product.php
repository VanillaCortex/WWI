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
SELECT s.StockItemID, s.StockItemName, s.RecommendedRetailPrice, s.MarketingComments, s.Photo, sih.QuantityOnHand
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
            <!--Foto van product (is nu 'no img available')-->
            <div class="col-md-6">
                <img width="70%" src="media/images/No_Image_Available.png" alt="">
            </div>
            <!--Prijsnotering-->
            <div class="col-md-6">
                <h3 class="head"><?= $product['StockItemName'] ?></h3>
                <br><br>
                <h4>Prijs per Stuk:</h4>
                <p>
                <h2 class="blackFriday">€ <?= round($product['RecommendedRetailPrice']*1.2, 2)  ?></h2>
                <h2 class="price">€ <?= $product['RecommendedRetailPrice']  ?></h2>
                </p>

                <?= $error ?>

                <p><h6>Vooraad: </h6> <?=$product['QuantityOnHand']?> </p>
                <form method="post">
                    <input class="form-control" type="number" name="aantal" min="1" max="<?=$product['QuantityOnHand']?>" value="1">
                    <input class="hidden" name="product" type="number" value="<?= $product['StockItemID'] ?>">
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
                    print("Hier moet nog een beschrijving aan worden toegevoegd");
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
        header("Refresh:0; url=product?" . $product_id . '/error');
        die;
    }

    // Initialize the class
    $cart = new Cart();

    // Add item to cart
    $item = $cart->addItemToCart($aantal, $product);

    // Refresh de pagina met een success bericht
    header("Refresh:0; url=product?" . $product_id . '/success');

}