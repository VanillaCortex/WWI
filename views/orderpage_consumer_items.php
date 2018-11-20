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
    </head>
    
    <?php
    // Header
    require_once 'header.php';
    ?>
    
    <div class="col-md-10 offset-md-1">
        <div class="row custom-container">
            <div class="col-sm-12">
                Winkelmand > Gegevens nakijken > Bevestig uw winkelmand
                <h2>Bevestig uw winkelmand</h2>
                <div class="nice-box">
                    <div class="col-sm-12 col-md-12 col-md-offset-1">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Productnaam</th>
                                    <th>Afbeelding</th>
                                    <th>Hoeveelheid</th>
                                    <th class="text-center">Prijs</th>
                                    <th class="text-center">Totaal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-sm-8 col-md-6">
                                        <h6 class="media-heading">Test</h6>
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        [X]
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        0
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        €0,00
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        €0,00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td><h6>Subtotaal</h6></td>
                                    <td class="text-right"><strong>$24.59</strong></td>
                                </tr>
                                <tr>
                                    <td><h6>Geschatte verzendkosten</h6></td>
                                    <td class="text-right"><strong>$6.94</strong></td>
                                </tr>
                                <tr>
                                    <td><h6>Totaal</h6></td>
                                    <td class="text-right"><strong>$31.53</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <button type="button" class="btn btn-default">
                                            Terug
                                        </button>
                                        <button type="button" class="btn btn-warning">
                                            Wijzigen
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            Bevestigen
                                        </button>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>