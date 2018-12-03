<style>
    .cart-icon {
        cursor: pointer;
        color: #00BDF3;
    }
    .cart-icon i{
        color: #00BDF3;
    }
    .cart-amount {
        max-width: 40px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>Cart</h1>
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
                            <th scope="col">Acties</th>
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
                                <td><a class="cart-icon hidden save-edit" data-action="save-edit" id="save-edit-<?=$key?>"><i class="fas fa-save"></i></a><a class="cart-icon edit" data-action="edit" id="edit-<?=$key?>" data-id="<?=$key?>"><i class="fas fa-edit"></i></a>  <a class="cart-icon remove" data-action="remove" data-toggle="modal" data-target="#exampleModal" id="remove-<?=$key?>"><i class="fas fa-trash-alt"></i></a>  </td>
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
                            <td></td>
                            <td id="total-price">€<?=$total?></td>
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

<script>

    // Edit knop actie
    $('body').on('click', '[data-action="edit"]', function(e){
        edit(e);
    });

    function edit(e) {

        // Haal het id op van het geklikte element
        target = $(e.target).parent();
        id = target.data('id');

        // Overal waar addClass staat word verstopt en daar waar niet word geshowed
        $('#edit-' + id).addClass('hidden');
        $('#save-edit-' + id).removeClass('hidden');
        $('#add-one-' + id).removeClass('hidden');
        $('#subtract-one-' + id).removeClass('hidden');
        $('#cart-amount-' + id).removeClass('hidden');
        $('#amount-' + id).addClass('hidden');
    }

    // Opslaan knop actie
    $('body').on('click', '[data-action="save-edit"]', function(e){
        save_edit(e);
    });

    function save_edit(e) {

        // Haal de id op van het geklikte element
        target = $(e.target).parent();
        id = target.attr('id').replace('save-edit-', '');

        // Haal het aantal op van de mutatie
        amount = $('#cart-amount-' + id).val();

        // Redirect naar deze url zodat de php functie word getriggered
        window.location.replace("?mutate=" + id + '-' + amount);

    }

    $('body').on('change', '[data-action="change-amount"]', function(e) {
        roundValue(e);
    });

    function roundValue(e) {

        target = $(e.target);
        amount = target.val();
        new_amount = Math.floor(amount);
        target.val(new_amount);

    }

    // Add one knop actie
    $('body').on('click', '[data-action="add-one"]', function(e){
        add_one(e);
    });

    function add_one(e) {

        // Haal het id op van het geklikte element
        target = $(e.target).parent();
        id = target.attr('id').replace('add-one-', '');

        // Haal het aantal van het product op
        num = $('#cart-amount-' + id).val();

        // Tel 1 bij het aantal op
        $('#cart-amount-' + id).val(parseInt(num)+1);
    }

    // Subtract one knop actie
    $('body').on('click', '[data-action="subtract-one"]', function(e){
        subtract_one(e);
    });

    function subtract_one(e) {

        // Haal het id op van het geklikte element
        target = $(e.target).parent();
        id = target.attr('id').replace('subtract-one-', '');

        // Haal het aantal van het product op
        num = $('#cart-amount-' + id).val();

        // Zolang het aantal hoger is dan 1 mag je er ééntje van af halen
        if(num > 1) {
            $('#cart-amount-' + id).val(num-1);
        }

    }

    $('body').on('click', '[data-action="remove"]', function (e) {

        target = $(e.target).parent();
        id = target.attr('id').replace('remove-', '');

        url = '/WWI/cart?remove=' + id;
        $('#remove').attr('href', url);

        $('#remove-modal').show();

    });

    $('body').on('click', '[data-dismiss="modal"]', function (e) {
        $('#remove-modal').hide();
    });

</script>


<div class="modal" id="remove-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"><p>Weet u zeker dat u dit product wilt verwijderen uit uw winkelmand?</p></div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button><a id="remove" href="" type="button" class="btn btn-primary">Ja</a>
            </div>
        </div>
    </div>
</div>