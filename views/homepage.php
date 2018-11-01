<?php

// Get all the catergories
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
    $image = $category['image'];
    echo base64_encode($category['image']);
    ?>
    <div class="col-sm-4">
        <div class="nice-box clickable">
            <a href="views/category.php?category=<?=$category['StockGroupID']?>">
                <?= $category['StockGroupName'] ?>
                <img src="media/images/logo.png" width="100%">
            </a>
        </div>
    </div>
    <?php
}
?>
</div>
