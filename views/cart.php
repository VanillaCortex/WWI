<?php
require_once '../conf/config.php';

// Get the url to do stuff with
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// Get the items and the amount for each product in an array (productid => amount)
//if(isset($_POST['cartamount'])):
//    $cartitems = $_POST['cartamount'];
//endif;
$cartitems = array(220 => 903998, 221 => 2, 222 => 1, 223 => 5);

// On page reload, check if items are deleted or amount is edited (forms method POST) / update items and amount items
//...

// Check if any cartamount is higher than the amount in the database / specify begin- and endpoints for the form number for each item ID (AFMAKEN, ook koppeling tot forms maken)
//$query3 = "SELECT *, sih.QuantityOnHand FROM stockitems s WHERE s.StockItemID = ?";
//$f = $pdo->prepare($query1);
//$f->execute(array($i));
//$f = $f->fetch();

// Functions if buttons + / - / X is pressed in a form to update values
//function higher ($id){
//    $cartitems[$id] = $cartitems[$id] + 1;
//    unset($_POST('higher'));
//}
//function lower ($id){
//    $cartitems[$id] = $cartitems[$id] - 1;
//    unset($_POST('lower'));
//}
//function remove($id){
//    unset($cartitems[$id]);
//    unset($_POST('remove'));
//}
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
                            echo("Uw winkelmand is leeg<br>");
                        else:
                            print("<table>");
                            print("<tr><td>Naam product</td><td>Plaatje</td><td>Prijs</td><td>Aantal</td></td><td></td><td><td>Verwijderen</td>");
                            foreach($cartitems as $i => $amount):
                                
                                // Get the quantity on hand of the item ID
                                $query3 = "SELECT sih.QuantityOnHand FROM stockitems s JOIN stockitemholdings sih ON s.StockItemID = sih.StockItemID WHERE s.StockItemID = ?";
                                $quantity = $pdo->prepare($query3);
                                $quantity->execute(array($i));
                                $quantity = $quantity->fetch();
                                
                                // Print if the quantity on hand is lower than entered value
                                if($quantity[0] < $amount):
                                    print("<br>Het ingevoerde aantal is aangepast aan het beschikbare aantal");
                                endif;
                                
                                // Lower if the quantity on hand is lower than entered value
                                while($quantity[0] < $cartitems[$i]):
                                    $cartitems[$i] = $cartitems[$i] - 1;
                                    $amount = $amount - 1;
                                endwhile;
                                
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
                                $totalprice += ($price[0] * $amount);
                                
                                // Print name, picture, price
                                print("<tr><td>" . $productname[0] . "</td><td>" . "[X]" . "</td><td>€" . $price[0] . "</td>");
                                
                                // In a form, print amount added to the cart, + and - button and a remove button
                                print("<td><form method=\"get\" action=\"http://localhost/WWI/views/cart.php\" name=\"" . $i . "\">" . $amount . "</td><td><input type=\"submit\" name=\"higher\" value=\"+\" onclick=\"higher()\">" . "</td><td><input type=\"submit\" name=\"lower\" value=\"-\" onclick=\"higher()\"> </td><td><input type=\"submit\" name=\"remove\" value=\"X\" onclick=\"higher()\"></form></td></tr>");
                                
                                // Remove item from array when deleted
//                                ...
                            endforeach;
                            print("</table>");
                        endif;
                        ?>
                        
                        Totaalprijs €<?=$totalprice?>
                        <form action="<?php if($request_uri[0]!=='/WWI/'){ print('../'); }?>">
                            <input type="submit" value="Verder Winkelen">
                        </form>
                        <?php // Vervang URL met link naar bestelling afronden. ?>
                        <form action="http://localhost/WWI">
                            <input type="submit" value="Bestelling Afronden">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
        ?>
    </body>
</html>
