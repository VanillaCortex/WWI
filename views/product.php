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
SELECT *, sih.QuantityOnHand
FROM stockitems s
JOIN stockitemholdings sih ON s.StockItemID = sih.StockItemID
WHERE s.StockItemID = ?";
$product = $pdo->prepare($query);
$product->execute(array($product_id));
$product = $product->fetch();

?>

<div class="col-md-10 offset-md-1">
    <div class="row custom-container">
        <div class="col-sm-12">
            <h1><?=$product['StockItemName']?></h1>
        </div>

        <div class="col-sm-7">
            <div class="nice-box">
<!--                    <img src="--><?//=$product['Photo']?><!--">-->
<!--                <img src="../media/images/no_image.jpg" width="50%">-->
                <img src="media/images/logo.png" width="100%">
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
</div>
