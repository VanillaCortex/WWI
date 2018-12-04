<!DOCTYPE html>
<html>
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
                                            <button onclick="window.location.href='/WWI/cart'" class="btn btn-default">
                                                Wijzig uw winkelmand
                                            </button>
                                            <?php
                                            if(FALSE){ ?>
                                                <button onclick="window.location.href='/WWI/method'" class="btn btn-primary">
                                                    Bevestigen
                                                </button>
                                            <?php
                                            } else { ?>
                                                <button onclick="window.location.href='/WWI/method_visitor'" class="btn btn-primary">
                                                    Bevestigen
                                                </button>
                                            <?php
                                            }; ?>
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