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
<!--                            <div class="col-md-6">
                                <div class="card-body">
                                    <h6 class="card-title">Contactgegevens:</h6>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email-adres</label><br>
                                        placeholder@gmail.com 
                                        <button type="button" class="btn btn-default">
                                            Aanpassen 
                                        </button>
                                        <div class="email-feedback">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tel" class="col-form-label">Telefoonnummer</label><br>
                                        +00 000000000 
                                        <button type="button" class="btn btn-default">
                                            Aanpassen
                                        </button>
                                        <div class="phone-feedback">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h6 class="card-title">Verzendadres:</h6>
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Land:</label>
                                        <select class="form-control" id="land">
                                            <option>Nederland</option>
                                            <option>Duitsland</option>
                                            <option>België</option>
                                        </select>
                                        <div class="land-feedback">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Provincie:</label>
                                        <select class="form-control" id="provincie">
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
                                        <label for="adres" class="col-form-label">Postcode:</label>
                                        <input type="text" class="form-control" id="tel" placeholder="1234 AA" required>
                                        <div class="postcode-feedback">

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="adres" class="col-form-label">Straatnaam en huisnummer:</label>
                                        <input type="text" class="form-control" id="tel" placeholder="De Straat 000" required>
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
                                        <select class="form-control" id="methode">
                                            <option>Sloom (€5.00)</option>
                                            <option>Gemiddeld (€15.00)</option>
                                            <option>Snel (€25.00)</option>
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
                                            <option value="rabobank">Rabobank</option>
                                            <option value="abn">ABN AMRO Bank</option>
                                            <option value="moonbank">Moonbank</option>
                                        </select>
                                    </div>
                                    <br>
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
                                    <button type="button" class="btn btn-success">
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