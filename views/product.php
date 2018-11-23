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
                <h2 class="price">€ <?= $product['RecommendedRetailPrice'] ?></h2>
                <br><br>
                <p><h6>Vooraad: </h6> <?=$product['QuantityOnHand']?> </p>
                <form method="post">
                    <input class="form-control" type="number" name="aantal" min="1" max="<?=$product['QuantityOnHand']?>" value="1">
                    <input class="hidden" name="product" type="number" value="<?= $product['StockItemID'] ?>">
                    <br>
                    <button class="float-right btn btn-success" type="submit">Toevoegen aan winkelwagen</button>
                </form>
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

    // Initialize the class
    $cart = new Cart();

    // Add item to cart
    $item = $cart->addItemToCart($aantal, $product);

    // Query om snel een category_id op te halen zodat we daar heen kunnen gaan
    $query = "SELECT StockGroupID FROM stockitemstockgroups WHERE StockItemID = ?";
    $category = $pdo->prepare($query);
    $category->execute(array($product_id));
    $category = $category->fetch();

    // Redirect naar de cart
    header('location: /WWI/category?' . $category['StockGroupID'] . '');

}