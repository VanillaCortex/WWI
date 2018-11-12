<?php
require_once '../conf/config.php';

// Get the url to do stuff with
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
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
                        $number1 = 0;
                        $number2 = 0;
                        $number3 = 0;
                        $number4 = 0;
                        ?>
                        <table>
                            <tr><td>product naam</td><td>plaatje</td><td>prijs</td><td><form>Aantal <input type="number" value="<?=$number1?>"> <input type="button" value="Verwijder"></form></td></tr>
                            <tr><td>product naam</td><td>plaatje</td><td>prijs</td><td><form>Aantal <input type="number" value="<?=$number2?>"> <input type="button" value="Verwijder"></form></td></tr>
                            <tr><td>product naam</td><td>plaatje</td><td>prijs</td><td><form>Aantal <input type="number" value="<?=$number3?>"> <input type="button" value="Verwijder"></form></td></tr>
                            <tr><td>product naam</td><td>plaatje</td><td>prijs</td><td><form>Aantal <input type="number" value="<?=$number4?>"> <input type="button" value="Verwijder"></form></td></tr>
                        </table>
                        Totaalprijs
                        <button>Verder winkelen</button>
                        <button>Bestelling afronden</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
