<!DOCTYPE html>
<html>
    <div class="col-md-10 offset-md-1">
        <div class="row container">
            <div class="col-sm-12">
                <div class="col-sm-12 col-md-12 col-md-offset-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1>Bevestig uw winkelmand</h1>
                            </div>
                            <div class="col-sm-12">
                                <div>
                                    <?php

                                    // Haal alles wat op dit moment in de cart zit op
                                    $supreme_cart = new Cart();
                                    $cart = $supreme_cart->getCart();

                                    // Als er argumenten achter de url staan
                                    if(isset($arguments)) {

                                        // Als de url 'remove=' bevat
                                        if(strpos($request, 'remove=') !== false) {

                                            // Zoek naar de key in de array waar de waarde 'remove=' bevat
                                            $key = array_search ('remove=', $arguments);

                                            // haal het product id op
                                            $remove = $arguments[$key];
                                            $remove = str_replace('remove=', '', $remove);

                                            // Verwijder de lijn van de cart
                                            $removed = $supreme_cart->removeLineFromCart($remove);
                                        }

                                        // Als de url mutate= bevat
                                        if(strpos($request, 'mutate=') !== false) {

                                            // Zoek naar de key in de array waar de waarde 'mutate=' staat
                                            $key = array_search('mutate=', $arguments);

                                            // Haal het product id op
                                            $mutate = $arguments[$key];
                                            $mutate = str_replace('mutate=', '', $mutate);

                                            // Splijt de string tussen de '-'
                                            $data = explode('-', $mutate);

                                            // Check of we er de goede data uit hebben
                                            if(is_array($data)) {

                                                // Haal het id er uit
                                                $id = $data[0];

                                                // Haal het aantal er uit
                                                $aantal = $data[1];

                                                // Muteer het aantal van een product
                                                $mutated = $supreme_cart->updateAantal($id, $aantal);

                                            } else {
                                                header('Location: /WWI/cart');
                                            }

                                        }

                                        // Check of er een error is
                                        if(in_array('error', $arguments)) {

                                            $error = '<div class="alert alert-danger" role="alert">Oops! Er is iets mis gegaan. Probeer het opnieuw of voer correcte data in</div>';

                                        }

                                    }

                                    ?>
                                    <div class="alert alert-primary text-center <?= (is_array($cart) ? 'hidden' : null) ?>" role="alert"><?php if(!is_array($cart)){ print($cart);} ?></div>
                                    <?php
                                    // Check of hij wel gevuld is
                                    if(is_array($cart)) {
                                        ?>

                                        <?= $error ?>

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Naam product</th>
                                                <th scope="col">Prijs per product</th>
                                                <th scope="col">Aantal</th>
                                                <th scope="col">Prijs</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            // Set de standaard waarde
                                            $total = 0;

                                            foreach($cart as $key => $item) {
                                                // Bereken het totaal
                                                $total += $item['aantal'] * $item['prijs_per'];
                                                ?>
                                                <tr id="line-<?=$key?>">
                                                    <td><a href="/WWI/product?<?=$item['product']?>"><?=$item['product_naam']?></a></td>
                                                    <td>€<?= floatval($item['prijs_per']) ?></td>
                                                    <td><a class="cart-icon hidden add-one" data-action="add-one" id="add-one-<?=$key?>"><i class="fas fa-plus-square"></i></a> <input class="cart-amount hidden" type="number" value="<?= $item['aantal'] ?>" id="cart-amount-<?=$key?>" data-action="change-amount"> <p id="amount-<?=$key?>"><?=$item['aantal']?></p> <a class="cart-icon hidden subtract-one" data-action="subtract-one" id="subtract-one-<?=$key?>"><i class="fas fa-minus"></i> </a></td>
                                                    <td id="product-price-<?=$key?>">€<?=floatval($item['prijs_per']*$item['aantal'])?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td id="total-price"><strong>€<?=$total?></strong></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="text-left">
                                        <button onclick="window.location.href='/WWI/cart'" class="btn btn-default">
                                            Wijzig uw winkelmand
                                        </button>
                                        <?php
                                        if(FALSE){ ?>
                                            <button onclick="window.location.href='/WWI/method'" class="btn btn-primary">
                                                Afrekenen
                                            </button>
                                        <?php
                                        } else { ?>
                                            <button onclick="window.location.href='/WWI/method_visitor'" class="btn btn-primary">
                                                Afrekenen
                                            </button>
                                        <?php
                                        }; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>