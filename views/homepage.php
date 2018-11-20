<?php
// Get all the categories
$query = '
SELECT s.StockGroupID, s.StockGroupName, (SELECT c.Photo FROM stockitems c WHERE c.StockItemID = b.StockItemID LIMIT 1) as image
FROM stockgroups s
JOIN stockitemstockgroups b ON s.StockGroupID = b.StockGroupID
GROUP BY s.StockGroupID';
$categories = $pdo->prepare($query);
$categories->execute();

?>
<div class="row custom-container">
<?php

while($category = $categories->fetch()) {
    switch ($category['StockGroupID']){
        case 1: 
            $afbeeldingnaam = "novelty_items.png";
            break;
        case 2:
            $afbeeldingnaam = "clothing.jpg";
            break;
        case 3:
            $afbeeldingnaam = "mugs.jpg";
            break;
        case 4:
            $afbeeldingnaam = "t-shirts.jpg";
            break;
        case 6:
            $afbeeldingnaam = "computing_novelties.jpg";
            break;
        case 7:
            $afbeeldingnaam = "usb_novelties.jpg";
            break;
        case 8:
            $afbeeldingnaam = "furry_footwear.jpg";
            break;
        case 9:
            $afbeeldingnaam = "toys.jpg";
            break;
        case 10:
            $afbeeldingnaam = "packaging_materials.jpg";
            break;
        default:
            $afbeeldingnaam = "no_image.jpg";
            break;
    }
    $image = $category['image'];
    echo base64_encode($category['image']);
    ?>
    <div class="col-md-4 col-sm-12">
        <div class="nice-box clickable">
            <a href="category?<?=$category['StockGroupID']?>">
                <?= $category['StockGroupName'] ?>
                <img src="media/images/<?=$afbeeldingnaam?>" width="100%">
            </a>
        </div>
    </div>
    <?php
}
?>
</div>
