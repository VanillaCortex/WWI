<?php
require_once '../conf/config.php';

// Get the url to do stuff with
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Get the cart items in an array (id => productid)
//if(isset($_POST['cartitems'])):
//    $cartitems = $_POST['cartitems'];
//endif;
$cartitems = array(220, 221, 222, 223);

// Get the amount for each product in an array (productid => amount)
//if(isset($_POST['cartamount'])):
//    $cartamount = $_POST['cartamount'];
//endif;
$cartamount = array(220 => 2, 221 => 4, 222 => 1, 223 => 5);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../media/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../media/javascript/jquery.js" type="text/javascript"></script>
        <?php
        // Header
        require_once 'header.php';
        ?>
    </head>
    <body>
        <div class="col-md-10 offset-md-1">
            <div class="row custom-container">
                <div class="col-sm-12">
                    <h1>Cart</h1>
                </div>
                <div class="col-sm-12">
                    <div class="nice-box">
                        <?php
                        // Set totalprice
                        $totalprice = 0;
                        
                        if(!isset($cartitems)):
                            // If there aren't any products added to the cart yet
                            echo("Uw winkelmand is leeg");
                        else:
                            print("<table>");
                            foreach($cartitems as $i):
                                
                                // Get the name of the cart item
                                $query1 = "SELECT si.StockItemName FROM stockitems si WHERE si.StockItemID = ?";
                                $productname = $pdo->prepare($query1);
                                $productname->execute(array($i));
                                $productname = $productname->fetch();
                                
                                // Get the price of the cart item (AANPASSEN)
                                $query2 = "SELECT si.RecommendedRetailPrice FROM stockitems si WHERE si.StockItemID = ?";
                                $price = $pdo->prepare($query2);
                                $price->execute(array($i));
                                $price = $price->fetch();
                                
                                // Count totalprice
                                $totalprice += ($price[0] * $cartamount[$i]);
                                
                                // Print name, picture, price
                                print("<tr><td>" . $productname[0] . "</td><td>" . "(plaatje)" . "</td><td>€" . $price[0] . "</td><td>");
                                
                                // In a form, print amount added to the cart and a remove button
                                print("<form>Aantal <input type=\"number\" value=\"" . $cartamount[$i] . "\"> <input type=\"button\" value=\"Verwijder\"></form></td></tr>");
                                
                                // Remove item from array
//                                ...
                            endforeach;
                            print("</table>");
                        endif;
                        
                        // Check if any cartamount is higher than the amount in the database
//                        $query3 = "SELECT *, sih.QuantityOnHand FROM stockitems s WHERE s.StockItemID = ?";
//                        $f = $pdo->prepare($query1);
//                        $f->execute(array($i));
//                        $f = $f->fetch();
                        ?>
                        Totaalprijs €<?=$totalprice?>
                        <form action="<?php if($request_uri[0]!=='/WWI/'){ print('../'); }?>">
                            <input type="submit" value="Verder Winkelen">
                        </form>
                        <form action="http://localhost/WWI">
                            <input type="submit" value="Bestelling Afronden">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
