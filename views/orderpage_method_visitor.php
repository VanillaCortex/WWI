<!DOCTYPE html>
<html>
    <div class="col-md-10 offset-md-1">
            <div class="col-sm-12">
            <h2>Gegevens nakijken</h2>
                    <form method = "post" action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h6 class="card-title">Billing information:</h6>
                                        <div class="form-group">
                                            <label for="sex">Sex</label>
                                                <select name = "sex" id="sex" class="form-control">
                                                    <option value="...">...</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Ms.">Ms.</option>
                                                    <option value="Alien ">Alien</option>
                                                    <option value="Snowflake">Special Snowflake</option>
                                            </select>
                                        </div>

                                    <div class="form-group">
                                         <label for="firstname">First Name</label>
                                        <input name = "firstname" type="text" class="form-control" id="firstname">
                                    </div>

                                    <div class="form-group">
                                         <label for="prefix">Prefix</label>
                                        <input name = "prefix" type="text" class="form-control" id="prefix">
                                    </div>

                                    <div class="form-group">
                                         <label for="lastname">Last Name</label>
                                        <input name = "lastname" type="text" class="form-control" id="lastname">
                                    </div>

                                    <div class="form-group">
                                    <label for="email"> E-mail
                                    </label>
                                    <input name = "email" type="email" class="form-control" id="email" placeholder="you@example.com">
                                    </div>

                                    <div class="form-group">
                                    <label for="phone"> Phone number
                                    </label>
                                    <input name = "nummer" type="address3" class="form-control" id="address3" placeholder="(+31)1234567890">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h6 class="card-title">Shipping address:</h6>
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Country:</label>
                                        <select name ="land" class="form-control" id="country">
                                            <option>The Netherlands</option>
                                            <option>Germany</option>
                                            <option>Belgium</option>
                                            <option>The Moon</option>
                                        </select>
                                        <div class="land-feedback">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Province/state:</label>
                                        <select name ="adres" class="form-control" id="provincie">
                                            <option>...</option>
                                            <option>Overijssel</option>
                                            <option>Friesland</option>
                                            <option>Drenthe</option>
                                            <option>Flevoland</option>
                                            <option>Gelderland</option>
                                            <option>Utrecht</option>
                                            <option>Noord-Holland</option>
                                            <option>Zuid-Holland</option>
                                            <option>Zeeland</option>
                                            <option>Noord-Brabant</option>
                                            <option>Limburg</option>
                                        </select>
                                        <div class="provincie-feedback">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Postal code:</label>
                                        <input name = "postcode" type="text" class="form-control" id="tel" placeholder="1234 AA" required>
                                        <div class="postcode-feedback">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Streetname and home number:</label>
                                        <input name = "streetname" type="text" class="form-control" id="tel" placeholder="Street name 000" required>
                                        <div class="straat-feedback">

                                        </div>
                                    </div>
                                    
                                    <h6 class="card-title">payment method:</h6>
                                    <input type="radio" name="paymentoption" id="ideal" checked="checked">
                                    <img src="<?= $request ?>/../media/images/ideal.jpeg" width="32" height="32">
                                    <label for="paymentoption">iDEAL</label>
                                    <div id="show-me">
                                        <label for="banks">Select your bank</label>
                                        <select id="banks" class="form-control">
                                            <option value="...">...</option>
                                            <option value="rabobank">Rabobank</option>
                                            <option value="abn">ABN AMRO Bank</option>
                                            <option value="moonbank">Moonbank</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <input type="radio" name="paymentoption" id="paypal">
                                        <img src="<?= $request ?>/../media/images/paypal.jpeg" width="32" height="32">
                                        <label for="paymentoption">PayPal</label>
                                        <br>
                                        <input type="radio" name="paymentoption" id="dogecoin">
                                        <img src="<?= $request ?>/../media/images/dogecoin.jpeg" width="32" height="32">
                                        <label for="paymentoption">DogeCoin</label>
                                        <br>
                                        <input type="radio" name="paymentoption" id="natura">
                                        <img src="<?= $request ?>/../media/images/wink.jpeg" width="32" height="32">
                                        <label for="paymentoption">Natura</label>

                                        <script>
                                        $('input[type="radio"]').click(function () {
                                            if (this.id == "ideal") {
                                                $("#show-me").show('slow');
                                            } else {
                                                $("#show-me").hide('slow');
                                            }
                                        });
                                        </script>
                                    
                                    </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <input type="checkbox" name="accept"> Accept the terms of service</input>
                                    <br><br>
                                    <button onclick="window.location.href='/WWI/confirm'" class="btn btn-default">
                                        Terug
                                    </button>
                                    <button onclick="window.location.href='/WWI/pay'" type="submit" class="btn btn-primary">
                                        Bevestigen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>
<?php
//post input in variabelen zetten zodat het makkelijker is ze te filteren en controleren
$sex = filter_input(INPUT_POST , "sex" , FILTER_SANITIZE_SPECIAL_CHARS);
$adres = filter_input(INPUT_POST , "adres" , FILTER_SANITIZE_SPECIAL_CHARS);
$payment = filter_input(INPUT_POST , "paymentoption" , FILTER_SANITIZE_SPECIAL_CHARS);
$accept = filter_input(INPUT_POST , "accept" , FILTER_SANITIZE_SPECIAL_CHARS);
$firstname = filter_input(INPUT_POST , "firstname" , FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST , "lastname" , FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST , "email" , FILTER_SANITIZE_EMAIL);
$land = filter_input(INPUT_POST , "land" , FILTER_SANITIZE_SPECIAL_CHARS);
$postalcode = filter_input(INPUT_POST , "postcode" , FILTER_SANITIZE_SPECIAL_CHARS);
$streetname = filter_input(INPUT_POST , "streetname" , FILTER_SANITIZE_SPECIAL_CHARS);
//controleren of de data is ingevult

if(isset($_POST) && !empty($_POST)) {

    if(empty($sex)) {
        print("Vul alstufblieft een geslacht in");
        die;
    }
    if(empty($firstname)) {
        print("Vul alstufblieft een naam in");
        die;
    }
    if(empty($lastname)) {
        print("Vul alstufblieft een achternaam in");
        die;
    }
    if(empty($email)) {
        print("Vul alstufblieft een email in");
        die;
    }
    if(empty($land)) {
        print("Vul alstufblieft een land in");
        die;
    }
    if(empty($adres)) {
        print("Vul alstublieft een adres in");
        die;
    }
    if(empty($postalcode)) {
        print("Vul alstufblieft een postcode in");
        die;
    }
    if(empty($streetname)) {
        print("Vul alstufblieft een straatnaam in");
        die;
    }
    if(empty($payment)) {
        print("Kies alstublieft een betaal optie");
        die;
    }
    if(empty($accept)) {
        print("U moet onze voorwaarden accepteren voordat u kunt bestellen");
        die;
    }

    $supreme_order = new Order();
    $order = $supreme_order->create();
    print_r($order);
    die;

}

?>