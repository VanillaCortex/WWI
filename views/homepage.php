<?php
// Get all the catergories
$query = '
SELECT StockGroupID, StockGroupName
FROM stockgroups ';
$categories = $pdo->prepare($query);
$categories->execute();

?>
<div class="divb">
    <div class="container">
        <h1 class="display-4 head centerText">Welkom op WWI</h1>

        <div class="">
            <img class="centerImg" width="50%" src="media/images/blackFriday.png" alt="">
        </div>
<!--        <button class="centerImg btn btn-primary">Over Ons</button>-->
        <br>
        <div style="display: inline">
            <h3 class="centerText">Check onze categorieën:</h3>
        </div>
        <hr class="my-4">
    </div>
</div>


<div class="diva">
    <div class="container gridItem">


        <div class="row">
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
                    $afbeeldingnaam = "shirt.jpg";
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
            if($category['StockGroupID'] != 5) {
                ?>
                <div class="col-md-4 cardSpace" style="width: 10rem">
                    <div class="card">
                        <div class="clickable">
                            <a href="category?<?= $category['StockGroupID'] ?>">
                                <img class="card-img-top" src="media/images/<?= $afbeeldingnaam ?>" alt=""><br>
                            </a>
                            <div class="card-body">
                                <strong>
                                    <p class="card-title"><?= $category['StockGroupName'] ?></p>
                                </strong>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="category?<?= $category['StockGroupID'] ?>" class="btn btn-primary">Bekijk de
                                    Producten</a>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
            }
        }
        ?>
        </div>
    </div>
</div>
