<?php
$q = $_GET["q"]; print("lol");
$pagination = 25;
$order = 0;
if(isset($arguments)) {
//    print_r($arguments);
    if(isset($arguments[0])) {
        $category = $arguments[0];
    }
    if(isset($arguments[1])) {
        $pagination = $arguments[1];
    }
    if(isset($arguments[2])) {
        $order = $arguments[2];
    }
} else {
    print('Oops! Er ging iets mis. Probeer terug te gaan naar de vorige pagina');
    die;
}
// Check in what order we have to get the products
switch ($order) {
    case 1:
        // Get the products of our Category but ascending
        $query = "
        SELECT * FROM stockitems WHERE StockItemName LIKE '%$q%'
        ORDER BY RecommendedRetailPrice ASC ";
        $products = $pdo->prepare($query);
        $products->execute(array($category));
        break;
    case 2:
        // Get the products of our Category
        $query = "
        SELECT * FROM stockitems WHERE StockItemName LIKE '%$q%'
        ORDER BY RecommendedRetailPrice DESC";
        $products = $pdo->prepare($query);
        $products->execute(array($category));
        break;
    default:
        // Get the products of our Category
        $query = "
        SELECT * FROM stockitems WHERE StockItemName LIKE '%$q%'";
        $products = $pdo->prepare($query);
        $products->execute(array($category));
        break;
}
// Count the amount of products
$count = $products->rowCount();
// Calculate how many pages we have to be able to scroll through
$pages = ceil($count / $pagination);
?>
<script>
    // Zodra de browser geladen is, laadt dit in
    window.onload = function() {
        // Zodra er binnen de body wordt geklikt op een element met een data target genaamd 'change_page'
        $('body').on('click', '[data-target="change_page"]', function (e) {
            // Zodra dit gebeurd is dat vuurt de functie 'change_page'
            change_page(e);
        });
        function change_page(e) {
            // Haalt het element op waar op geklikt is
            var target = $(e.target);
            // Haalt de class active weg bij alle elementen die deze class hebben
            $('.active').removeClass('active');
            // Haal de id op van het geklikte element
            var id = target.attr('id');
            // Geeft het element wat om ons geklikt element heen zit de class active
            $('#' + id).parent().addClass('active');
            // Haalt het tekst gedeelte van de id, omdat deze niet meer nodig is
            id = id.replace('page_', '');
            // Bereken een aantal variabelen om mee te rekenen
            var start = (parseInt(id) - 1) * <?=$pagination?>;
            var end = parseInt(id) * <?=$pagination?>;
            counter = start;
            // Laat de nieuwe producten van de nieuwe pagina zien
            while(counter <= end) {
                $('#' + counter).removeClass('hidden');
                counter++;
            }
            // Verstop de producten die voor onze selectie zijn
            counter = start;
            while(counter > 0) {
                counter--;
                $('#' + counter).addClass('hidden');
            }
            // Verstop de producten die na onze selectie zijn
            counter = end;
            while(counter < <?=$count?>) {
                counter++;
                $('#' + counter).addClass('hidden');
            }
        }
    };
</script>


<div class="divb gridItem">
    <div class="container">
        <h2 class="head">Resultaten voor: <br> '<?= $q ?>'</h2>
        <br>

    </div>
</div>
<div class="diva">
    <div class="container gridItem">
        <div class="row">
            <div class="col-md-4">
                <p>Producten per pagina</p>
                <a href="search?q=<?=$q?>&/25"><button class="btn btn-small btn-primary">25</button></a>
                <a href="search?q=<?=$q?>&/50"><button class="btn btn-small btn-primary">50</button></a>
                <a href="search?q=<?=$q?>&/100"><button class="btn btn-small btn-primary">100</button></a>
            </div>
            <div class="col-md-4">
<!--                <p>Omschrijving </p>-->
            </div>
            <div class="col-md-4">
                <p>Sorteren op prijs</p>
                <a href="search?q=<?=$q?>&/<?=$pagination?>/1"><button class="btn btn-small btn-primary"><i class="fas fa-sort-amount-up"></i></button></a>
                <a href="search?q=<?=$q?>&/<?=$pagination?>/2"><button class="btn btn-small btn-primary"><i class="fas fa-sort-amount-down"></i></button></a>
            </div>
        </div>
        <br>
        <hr>
    </div>
</div>
<div class="divb">
    <div class="container gridItem">
        <div class="row">
            <?php
            $x=0;
            while($product = $products->fetch()){
                $x++;
                ?>
                <div class="col-md-4 cardSpace <?php if($x>$pagination){echo 'hidden';} ?>" id=<?=$x?>>
                    <div class="card">
                        <a href="product?<?=$product['StockItemID']?>">
                            <img class="card-img-top" src="media/images/No_Image_Available.png" alt=""><br>
                        </a>
                        <strong>
                            <p class="card-title">
                                <?= $product['StockItemName'] ?>
                            </p>
                            <p class="card-text">
                                <b>Prijs: </b>€<?=$product['RecommendedRetailPrice']?>
                            </p>
                        </strong>
                    </div>

                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>
<br>
<br>
<div class="container">
    <nav aria-label="...">
        <ul class="pagination pagination-lg float-right">
        <?php
            $page_array = range(1, $pages);
            foreach($page_array as $page) {
                ?>
                <li class="page-item  <?php if($page == 1) { echo 'active'; }?>" data-target="change_page"><a class="page-link" id="page_<?=$page?>"><?=$page?></a></li>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>