<?php
    // Als iemand al is ingelogd heeft hij/zij geen toegang tot deze pagina
    if($_SESSION['logged_in'] && $_SESSION['logged_in'] == 1) {
        echo '<script>window.location.replace("/WWI/");</script>';
    }
?>
<html>
    <head>
        <title>Registratie</title>
    </head>
    <div class = centerText>
        <i class="fas fa-user-plus fa-7x"></i>
    </div>
    <body>
        <form method ="post" action="">
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-3">

                    </div>
                    <div class="form-group col-md-6">
                        E-Mailadress<input name = "emailadress" type = 'email' class="form-control"> <br>
                        Name<input name = "name" type = 'text' class="form-control"> <br>
                        Password (needs to be 8 characters or more) <input name = "password" type = "password" minlength= "8" maxlength = "30" class="form-control"> <br>
                        Confirm Password (must match the previous password)<input name = "confirmpassword" type = "password" minlength = "8" maxlength = "30" class="form-control" > <br>
                        <input name = "bevestig account" type = "submit" value = "Bevestig account" class="btn btn-primary"> <br>
                    </div>
                    <div class="form-group col-md-3">

                    </div>
                </div>
            </div>
        </form>

        <?php

            if(isset($_POST) && isset($_POST['emailadress']) && isset($_POST['name']) && isset($_POST['password'])) {
                //controleren of alle infortmatie is ingevuld
                if(empty($_POST["emailadress"])) {
                    print("vul een e-mailadres in!");
                    die;
                }
                if(empty($_POST["name"])) {
                    print("vul een naam in!");
                    die;
                }
                if(empty($_POST["password"])) {
                    print("vul een wachtwoord in!");
                    die;
                } elseif(($_POST["password"] != $_POST["confirmpassword"])) {
                    print("wachtwoorden moeten overeenkomen!");
                    die;
                }

                //wachtwoord hashen, de data filteren en het in de datbase invoeren
                $hashedpw = password_hash(INPUT_POST["password"] , PASSWORD_DEFAULT);
                $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
                $emailadres = filter_var($_POST["emailadress"], FILTER_SANITIZE_EMAIL);

                $query = "INSERT INTO users (naam, email, password)
                          values(?, ?, ?)";
                $insert = $pdo->prepare($query);
                $insert->bindParam(1,$name);
                $insert->bindParam(2, $emailadres);
                $insert->bindParam(3, $hashedpw);

                try {
                    $insert->execute();
                    print('<h1>Success!</h1>');
                } catch (PDOException $p) {
                    print($p->getMessage());
                }
            }

        ?>

    </body>
</html>