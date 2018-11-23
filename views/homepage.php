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
        <h1 class="display-4 head">Wide World Importers</h1>
        <p class="lead">Welkom op onze website.</p>
        <hr class="my-4">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur consequuntur cumque doloremque eius eos fuga harum impedit ipsa mollitia nam natus necessitatibus nemo numquam perferendis quam, reiciendis, repellendus sed tempore?</p>
        <a class="btn btn-primary btn-lg" href="about" role="button">Meer info</a>
    </div><br><br>
</div>
<br>
<div class="diva">
    <div class="container">
        <H2 class="head" align="center">Wij zijn:</H2>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-4 gridItem">
                <i class="fas fa-shipping-fast fa-7x"></i>
                <h5>Snel</h5>
            </div>
            <div class="col-md-4 gridItem">
                <i class="far fa-money-bill-alt fa-7x"></i>
                <h5>Goedkoop</h5>
            </div>
            <div class="col-md-4 gridItem">
                <i class="far fa-handshake fa-7x"></i>
                <h5>Betrouwbaar</h5>
            </div>
        </div>
        <br>
        <br>
        <br>

    </div>
</div>
<div class="divb">
    <div class="container gridItem">
        <h4 class="head">Check onze categorieën</h4>
        <hr>
        <br><br>
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
