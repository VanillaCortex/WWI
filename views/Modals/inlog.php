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
                <form method="POST" action="<?= $request ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email adres</label>
                        <input type="email" name="inlog_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email invoeren">
                        <small id="emailHelp" class="form-text text-muted">Wij zullen nooit uw email adres delen met iemand anders.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Wachtwoord</label>
                        <input type="password" name="inlog_password" class="form-control" id="exampleInputPassword1" placeholder="Wachtwoord invoeren">
                        <small id="emailHelp" class="form-text text-muted">Het wachtwoord moet voldoen aan onze criteria.</small>
                    </div>
                    <div class="modal-footer">
                        <a href="registratie" class="btn btn-secondary" target="_blank" style="background-color: #343a40">Registreer</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Terug</button>
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

    if(isset($_POST['inlog_email']) && !empty($_POST['inlog_email']) && isset($_POST['inlog_password']) && !empty($_POST['inlog_password'])) {

        // Log de gebruiker in als alles goed is ingevuld is
        $user = new User();
        $user = $user->login($_POST['inlog_email'], $_POST['inlog_password']);
        die;

    }
?>