<?php

global $pdo;

class User {

    private $pdo;

    function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/WWI/conf/config.php';
        global $pdo;
        $this->pdo = $pdo;
    }

    public function create() {

    }

    public function login($emailadres, $wachtwoord) {

        $user = '<div class="alert alert-danger" role="alert">Oops! Het emailadres of wachtwoord komt niet voor in onze database!</div>';

        $query = "SELECT PreferredName, HashedPassword FROM people WHERE EmailAddress = ? LIMIT 1";
        $get = $this->pdo->prepare($query);
        $get->execute(array($emailadres));
        $output = $get->fetchObject();

        $actual_password = $output->HashedPassword;

        if (password_verify($wachtwoord, $actual_password)) {

            if(session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user'] = $output->PreferredName;
            $_SESSION['logged_in'] = 1;

            $user = '<div class="alert alert-success" role="alert">Successvol ingelogd!</div>';

        } else {
            $_SESSION['logged_in'] = 0;
        }

        echo '<script>window.location.replace("/WWI/");</script>';;
        return $user;

    }

}