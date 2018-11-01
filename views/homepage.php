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
<div class="row">
<?php
while($category = $categories->fetch()) {
    $image = $category['image'];
    echo base64_encode($category['image']);
    ?>
    <div class="col-sm-3">
        <div class="category-box">
            <form method="get" action="views/category.php">
            <input type="hidden" value="<?=$category['StockGroupID']?>">
            <?= $category['StockGroupName'] ?>
            <img src="media/images/logo.png" width="100%">
            </form>
        </div>
    </div>
    <?php
}
?>
</div>
