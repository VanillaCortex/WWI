<!DOCTYPE html>
<html>
    <div class="col-md-10 offset-md-1">
        <div class="row custom-container">
            <div class="col-sm-12">
            Winkelmand > Gegevens nakijken
            <h2>Gegevens nakijken</h2>
                <div class="nice-box">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h6 class="card-title">Billing information:</h6>
                                        <div class="form-group">
                                            <label for="sex">Sex</label>
                                                <select id="sex" class="form-control">
                                                    <option value="...">...</option>
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Ms.">Ms.</option>
                                                    <option value="Alien ">Alien</option>
                                            </select>
                                        </div>

                                    <div class="form-group">
                                         <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" id="firstname">
                                    </div>

                                    <div class="form-group">
                                         <label for="prefix">Prefix</label>
                                        <input type="text" class="form-control" id="prefix">
                                    </div>

                                    <div class="form-group">
                                         <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" id="lastname">
                                    </div>

                                    <div class="form-group">
                                    <label for="email"> E-mail
                                    </label>
                                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                    </div>

                                    <div class="form-group">
                                    <label for="phone"> Phone number
                                    </label>
                                    <input type="address3" class="form-control" id="address3" placeholder="(+31)1234567890">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h6 class="card-title">Shipping address:</h6>
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Country:</label>
                                        <select class="form-control" id="country">
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
                                        <select class="form-control" id="provincie">
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
                                        <input type="text" class="form-control" id="tel" placeholder="1234 AA" required>
                                        <div class="postcode-feedback">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Streetname and home number:</label>
                                        <input type="text" class="form-control" id="tel" placeholder="Street name 000" required>
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
                                    <div class="form-group">
                                        <h6 class="card-title">Shipping method:</h6>
                                        <select class="form-control" id="methode">
                                            <option>Slow (€5.00)</option>
                                            <option>Average (€15.00)</option>
                                            <option>Fast (€25.00)</option>
                                        </select>
                                    </div>    
                                </div>
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