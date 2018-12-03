<?php
?>

<div class="modal fade" id="inlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inloggen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= $request ?>"><!--Hier begint de form-->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email adres</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email invoeren">
                        <small id="emailHelp" class="form-text text-muted">Wij zullen nooit uw email adres delen met iemand anders.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Wachtwoord</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Wachtwoord invoeren">
                        <small id="emailHelp" class="form-text text-muted">Het wachtwoord moet voldoen aan onze criteria.</small>
                    </div>
                    <div class="modal-footer">
                        <a href="registratie.php" class="btn btn-secondary" target="_blank" style="background-color: #343a40">Registreer</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                        <button type="submit" class="btn btn-primary">Log in</button>
                        <?php print_r($_POST);
                        if(isset($_POST) && !empty($_POST)){
                            $emailadres = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                            $wachtwoord = filter_input(INPUT_POST, 'password', PASSWORD_DEFAULT);
                            $hashedpw = password_hash(INPUT_POST["wachtwoord"] , PASSWORD_DEFAULT);
                            $query = "
                                                SELECT PersonID, PreferredName, HashedPassword, EmailAddress
                                                FROM People
                                                WHERE EmailAddress = ':emailadres' AND HashedPassword = ':wachtwoord'";
                            $user = $pdo->prepare($query);

                            $user->bindParam(':emailadres', $emailadres);
                            $user->bindParam(':wachtwoord', $wachtwoord);

                            $user->excute();
                            print_r($user);


                            if($user !== 'fucked_up') {
                                $_SESSION['user']['name'] = $user['naam'];
                                $_SESSION['ingelogd'] = 1;
                            }

                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
