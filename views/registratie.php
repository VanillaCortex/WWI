<html>
    <head>
        <title>Login page</title>
    </head>
    <h1>Create your account</h1>
    <body> 
        <form method ="post" action="">
        <input name = "emailadress" type = 'email'> E-Mailadress <br>
        <input name = "name" type = 'text'> Name <br>
        <input name = "password" type = "password" minlength= "2" maxlength = "30" > Password (needs to be 10 characters or more) <br>
        <input name = "confirmpassword" type = "password" minlength = "2" maxlength = "30" > Confirm Password (must match the previous password) <br>
        <input name = "bevestig account" type = "submit" value = "Bevestig account" > <br>
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