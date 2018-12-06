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

        $user = '<div class="alert alert-danger" role="alert">Oops! Iets is fout!</div>';

        $query = "SELECT id, naam, email, password FROM users WHERE email = ?";
        $get = $this->pdo->prepare($query);
        $get->execute(array($emailadres));
        $output = $get->fetchObject();

        $password = $output->password;

        print($wachtwoord . '<br>' . $password . '<br>');

        if (password_verify($wachtwoord, $password)) {

            if(session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user'] = $output->naam;
            $_SESSION['user_id'] = $output->id;
            $_SESSION['logged_in'] = 1;

            $user = '<div class="alert alert-success" role="alert">Successvol ingelogd!</div>';

        } else {
            $_SESSION['logged_in'] = 0;
        }

        echo '<script>window.location.replace("/WWI/");</script>';
        return $user;

    }

    public function logout()
    {

        session_destroy();
        return 'done';

    }

}