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
                                        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){ ?>
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