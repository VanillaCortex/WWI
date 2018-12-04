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
                        Password (needs to be 10 characters or more) <input name = "password" type = "password" minlength= "10" maxlength = "30" class="form-control"> <br>
                        Confirm Password (must match the previous password)<input name = "confirmpassword" type = "password" minlength = "10" maxlength = "30" class="form-control" > <br>
                        <input name = "bevestig account" type = "submit" value = "Bevestig account" class="btn btn-primary"> <br>
                    </div>
                    <div class="form-group col-md-3">

                    </div>
                </div>
            </div>
        </form>

        <?php

            if(isset($_POST)) {
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

                $personid = "
                    SELECT max(PersonID) FROM people";
                $data = $pdo->prepare($personid);
                $data->execute();
                $maxpersonid = $personid++;
                $query = "
                INSERT INTO people (PersonID, Fullname, PreferredName, searchName , IsPermittedToLogon, 
                IsExternalLogonProvider, HashedPassword, IsSystemUser, IsEmployee,
                IsSalesperson, EmailAddress , LastEditedBy , ValidFrom, ValidTo) 
                VALUES (':PersonID', 'testuser', ':name' , 'user', 1 ,
                0 , ':hashedpw' , 1 , 0 , 
                0 , ':emailadres' ,  '2', '9999-12-31 23:59:59', ' 9999-12-31 23:59:59' )";
                print("help");
                $insert = $pdo->prepare($query);
                $insert->bindParam(':PersonID', $maxpersonid, PDO::PARAM_INT);
                $insert->bindParam(":name", $name, PDO::PARAM_STR);
                $insert->bindParam(":hashedpw", $hashedpw, PDO::PARAM_STR);
                $insert->bindParam(":emailadres", $emailadres, PDO::PARAM_STR);
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