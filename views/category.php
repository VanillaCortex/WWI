<?php
require_once '../conf/config.php';
// Check if the get was succesfull and if the desired value is present
if(!isset($_GET) && !isset($_GET['category'])) {
    print('Oops! Something went wrong. Try and return to the previous page');
    die;
}
// Get the category from the GET
$category = $_GET['category'];

if(isset($_GET['pagination'])) {
    // Get pagination amount
    $pagination = $_GET['pagination'];
} else {
    $pagination = 25;
}

if(isset($_GET['order'])) {
    // Order type
    $order = $_GET['order'];
} else {
    $order = 0;
}

// Get the url to do stuff with
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Check in what order we have to get the products
switch ($order) {
    case 1:
        // Get the products of our Category but ascending
        $query = "
        SELECT s.* 
        FROM stockitems s 
        WHERE s.StockItemID 
        IN(
        SELECT b.StockItemId 
        FROM stockitemstockgroups b 
        WHERE b.StockGroupID = ?)
        ORDER BY s.RecommendedRetailPrice ASC ";
        $products = $pdo->prepare($query);
        $products->execute(array($category));
        break;
    case 2:
        // Get the products of our Category
        $query = "
        SELECT s.* 
        FROM stockitems s 
        WHERE s.StockItemID 
        IN(
        SELECT b.StockItemId 
        FROM stockitemstockgroups b 
        WHERE b.StockGroupID = ?)
        ORDER BY s.RecommendedRetailPrice DESC";
        $products = $pdo->prepare($query);
        $products->execute(array($category));
        break;
    default:
        // Get the products of our Category
        $query = "
        SELECT s.* 
        FROM stockitems s 
        WHERE s.StockItemID 
        IN(
        SELECT b.StockItemId 
        FROM stockitemstockgroups b 
        WHERE b.StockGroupID = ?) ";
        $products = $pdo->prepare($query);
        $products->execute(array($category));
        break;
}

// Count the amount of products
$count = $products->rowCount();

// Calculate how many pages we have to be able to scroll through
$pages = ceil($count / $pagination);

$query = "
SELECT *
FROM stockgroups
WHERE StockGroupID = ?";
$this_category = $pdo->prepare($query);
$this_category->execute(array($category));
$this_category = $this_category->fetch();

?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../media/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../media/javascript/jquery.js" type="text/javascript"></script>
    </head>
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
    <?php
    // Header
    require_once 'header.php';
    ?>
    <div class="col-md-10 offset-md-1">
        <div class="row custom-container">

            <div class="col-sm-12">
                <div class="nice-box">
                    <h3><?= $this_category['StockGroupName'] ?></h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="col-sm-12">
                                    <p><b>Aantal producten per pagina</b></p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="btn-group mr-2 float-left" role="group" aria-label="First group">
                                        <a href="category.php?category=<?=$this_category['StockGroupID']?>&pagination=25"><button type="button" class="btn btn-secondary">25</button></a>
                                        <a href="category.php?category=<?=$this_category['StockGroupID']?>&pagination=50"><button type="button" class="btn btn-secondary">50</button></a>
                                        <a href="category.php?category=<?=$this_category['StockGroupID']?>&pagination=100"><button type="button" class="btn btn-secondary">100</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="col-sm-12">
                                    <p class="text-right"><b>Prijs ordening</b></p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="btn-group mr-2 float-right" role="group" aria-label="First group">
                                        <a href="category.php?category=<?=$this_category['StockGroupID']?>&pagination=<?=$pagination?>&order=0"><button type="button" class="btn btn-secondary">X</button></a>
                                        <a href="category.php?category=<?=$this_category['StockGroupID']?>&pagination=<?=$pagination?>&order=1"><button type="button" class="btn btn-secondary">></button></a>
                                        <a href="category.php?category=<?=$this_category['StockGroupID']?>&pagination=<?=$pagination?>&order=2"><button type="button" class="btn btn-secondary"><</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php
            $x = 0;
            while($product = $products->fetch()) {
                $x++;
                ?>
                <div class="col-md-4 col-sm-12 <?php if($x > $pagination) { echo 'hidden';   } ?>" id="<?=$x?>">
                    <div class="nice-box clickable">
                        <a href="product.php?product=<?=$product['StockItemID']?>">
                            <?= $product['StockItemName'] ?>
                            <?=$product['Photo']?>
                            <img src="../media/images/no_image.jpg" width="50%">
                            <p><b>Prijs:</b> €<?=$product['RecommendedRetailPrice']?></p>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <nav aria-label="...">
            <ul class="pagination pagination-lg">
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
</html>
