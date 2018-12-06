<!DOCTYPE html>
<html>
<div class="col-md-10 offset-md-1">
    <div class="row custom-container">
        <div class="col-sm-12">
            Winkelmand > Gegevens nakijken
            <h2>Gegevens nakijken</h2>
            <div class="nice-box">
                <form method ="post" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h6 class="card-title">Verzendadres:</h6>
                                <div class="form-group">
                                    <label class="col-form-label">Land:</label>
                                    <select name = "land" class="form-control" id="land">
                                        <option name = "nederland" >Nederland</option>
                                        <option name = "duitsland" >Duitsland</option>
                                        <option name = "belgie" >België</option>
                                    </select>
                                    <div class="land-feedback">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Provincie:</label>
                                    <select name = "provincie" class="form-control" id="provincie">
                                        <option name = "overijssel" >Overijssel</option>
                                        <option name = "friesland" >Friesland</option>
                                        <option name = "drenthe" >Drenthe</option>
                                        <option name = "flevoland" >Flevoland</option>
                                        <option name = "gelderland" >Gelderland</option>
                                        <option name = "utrecht" >Utrecht</option>
                                        <option name = "noordholland" >Noord-Holland</option>
                                        <option name = "zuidholland" >Zuid-Holland</option>
                                        <option name = "zeeland" >Zeeland</option>
                                        <option name = "noordbrabat" >Noord-Brabant</option>
                                        <option name = "limburg" >Limburg</option>
                                    </select>
                                    <div class="provincie-feedback">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Postcode:</label>
                                    <input type="text" name = "postcode" class="form-control" id="postcode" placeholder="1234 AA" required>
                                    <div class="postcode-feedback">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Straatnaam en huisnummer:</label>
                                    <input type="text" name ="adres" class="form-control" id="adres" placeholder="De Straat 000" required>
                                    <div class="straat-feedback">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h6 class="card-title">Verzendmethode:</h6>

                                <div class="form-group">
                                    <select  name = "verzendmethode" class="form-control" id="methode">
                                        <option name = "sloom" value = "sloom" >Sloom (€5.00)</option>
                                        <option name = "gemiddeld" value = "gemiddeld" >Gemiddeld (€15.00)</option>
                                        <option name = "snel" value = "snel" >Snel (€25.00)</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h6 class="card-title">Betaalmethode:</h6>
                                <input type="radio" name="paymentoption" id="ideal" checked="checked">
                                <img src="<?= $request ?>/../media/images/ideal.jpeg" width="32" height="32">
                                <label for="paymentoption">iDEAL</label>
                                <div id="show-me">
                                    <label for="banks">Select your bank</label>
                                    <select id="banks" class="form-control">
                                        <option value="...">...</option>
                                        <option name = "rabobank" value="rabobank">Rabobank</option>
                                        <option name = "abn amro" value="abn">ABN AMRO Bank</option>
                                        <option name = "moonbank" value="moonbank">Moonbank</option>
                                    </select>
                                </div>
                                <br>
                                <input type="radio" name="paymentoption" id="paypal">
                                <img src="<?= $request ?>/../media/images/paypal.jpeg" width="32" height="32">
                                <label>PayPal</label>
                                <br>
                                <input type="radio" name="paymentoption" id="dogecoin">
                                <img src="<?= $request ?>/../media/images/dogecoin.jpeg" width="32" height="32">
                                <label>DogeCoin</label>
                                <br>
                                <input type="radio" name="paymentoption" id="natura">
                                <img src="<?= $request ?>/../media/images/wink.jpeg" width="32" height="32">
                                <label>Natura</label>

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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <input type="checkbox" name="accept">Accepteer de gebruikersvoorwaarden</input>
                                <br><br>
                                <button type="button" class="btn btn-default">
                                    Terug
                                </button>
                                <button type="submit" value =" bevestig account" class="btn btn-success">
                                    Bevestigen
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</html>
<?php

// Check of de post bestaat
if(isset($_POST) && !empty($_POST)) {
    // Check per veld of deze goed is ingevuld
    if (!empty($_POST) && empty($_POST["paymentoption"])) {
        print("U moet een betaalmethode kiezen");
        die;
    }
    if (!empty($_POST) && empty($_POST["verzendmethode"])) {
        print("U moet een verzendmethode kiezen");
        die;
    }
    if (!empty($_POST) && empty($_POST["accept"])) {
        print("Accepteer alstublieft de gebruiksvoorwaarden");
        die;
    }

    // Als alles voldoet aan de voorwaarden dan maken we de order aan
    $supreme_order = new Order();
    $order = $supreme_order->create();

}


