
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

</script>

<div class="row custom-container">
    <div class="col-sm-12">
        <h1>Cart</h1>
    </div>
    <div class="col-sm-12">
        <div class="nice-box">
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

                }

                ?>
                <div class="alert alert-primary text-center <?= (is_array($cart) ? 'hidden' : '') ?>" role="alert">
                        <?php if(!is_array($cart)){ print($cart);} ?>
                </div>
                <?php
                // Check of hij wel gevuld is
                if(is_array($cart)) {
                    ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Acties</th>
                            <th scope="col">Naam product</th>
                            <th scope="col">Plaatje</th>
                            <th scope="col">Aantal</th>
                            <th scope="col">Prijs</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php

                    // Haal het totaal op en gooi daarna die waarde uit de array zodat het niet stoort
                    $total = $cart['totaal_prijs'];
                    unset($cart['totaal_prijs']);

                    foreach($cart as $key => $item) {
                        ?>
                        <tr id="line-<?=$key?>">
                            <td><a class="cart-icon hidden save-edit" data-action="save-edit" id="save-edit-<?=$key?>"><i class="fas fa-save"></i></a><a class="cart-icon edit" data-action="edit" id="edit-<?=$key?>" data-id="<?=$key?>"><i class="fas fa-edit"></i></a>  <a href="/WWI/cart?remove=<?=$item['product']?>" class="cart-icon remove" data-action="remove" id="remove-<?=$key?>"><i class="fas fa-trash-alt"></i></a>  </td>
                            <td><a href="/WWI/product?<?=$item['product']?>"><?=$item['product_naam']?></a></td>
                            <td>//</td>
                            <td><a class="cart-icon hidden add-one" data-action="add-one" id="add-one-<?=$key?>"><i class="fas fa-plus-square"></i></a> <input class="cart-amount hidden" type="number" value="<?= $item['aantal'] ?>" id="cart-amount-<?=$key?>"> <p id="amount-<?=$key?>"><?=$item['aantal']?></p> <a class="cart-icon hidden subtract-one" data-action="subtract-one" id="subtract-one-<?=$key?>"><i class="fas fa-minus"></i> </a></td>
                            <td id="product-price-<?=$key?>">€<?=$item['prijs_per']*$item['aantal']?></td>
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

            <!-- Afreken knop hier -->

        </div>
    </div>
</div>