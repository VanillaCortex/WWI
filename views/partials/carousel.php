
<style>
    .carousel-inner {
        min-height: 550px;
        max-height: 550px;
    }
</style>

<?php

$query = "SELECT image FROM product_images WHERE product_id = ?";
$product_image = $pdo->prepare($query);
$product_image->execute(array($product_id));
$product_image = $product_image->fetchAll();

$afbeeldingnaam = [];

if(count($product_image) > 1) {

    foreach($product_image as $image) {
        array_push($afbeeldingnaam, 'products/'. $image['image']);
    }

} else {

    $query = "SELECT StockGroupID FROM stockitemstockgroups WHERE StockItemID = ?;";
    $categories = $pdo->prepare($query);
    $categories->execute(array($product_id));
    $categories = $categories->fetchAll();

    $clean_categories = [];
    foreach($categories as $category) {
        array_push($clean_categories, $category['StockGroupID']);
    }

    foreach($clean_categories as $category) {

        switch ($category) {
            case 1:
                array_push($afbeeldingnaam, "novelty_items.png");
                break;
            case 2:
                array_push($afbeeldingnaam, "clothing.jpg");
                break;
            case 3:
                array_push($afbeeldingnaam, "mugs.jpg");
                break;
            case 4:
                array_push($afbeeldingnaam, "shirt.jpg");
                break;
            case 6:
                array_push($afbeeldingnaam, "computing_novelties.jpg");
                break;
            case 7:
                array_push($afbeeldingnaam, "usb_novelties.jpg");
                break;
            case 8:
                array_push($afbeeldingnaam, "furry_footwear.jpg");
                break;
            case 9:
                array_push($afbeeldingnaam, "toys.jpg");
                break;
            case 10:
                array_push($afbeeldingnaam, "packing_materials.jpg");
                break;
            default:
                array_push($afbeeldingnaam, "no_image.jpg");
                break;
        }

    }

}

?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach($afbeeldingnaam as $key => $afbeelding) { ?>
            <div class="carousel-item <?php if($key == 0) { echo 'active'; } ?>">
                <img class="d-block w-100" src="media/images/<?= $afbeelding ?>">
            </div>
        <?php } ?>
    </div>

    <?php if(count($afbeeldingnaam) > 1) { ?>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Vorige</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Volgende</span>
        </a>
    <?php } ?>
</div>