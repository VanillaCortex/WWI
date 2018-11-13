<?php

global $pdo;

class Cart {

    private $pdo;

    function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/WWI/conf/config.php';
        global $pdo;
        $this->pdo = $pdo;
    }

    public function addItemToCart ($aantal, $product) {

        // Start de sessie als deze nog niet was gestart
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Als dit product al in de array zit voeg dan alleen het aantal op
        if(isset($_SESSION['orderlines']) && !empty($_SESSION['orderlines']) && isset($_SESSION['orderlines'][$product])) {
            $_SESSION['orderlines'][$product]["aantal"] += $aantal;
            print_r($_SESSION['orderlines'][$product]);
            print('<br>' . 'nou?');
            die;
        } else {
            // Haal wat additionele informatie op over het product, zodat we dit later niet meer hoeven te doen
            $query = "
            SELECT s.StockItemName, s.RecommendedRetailPrice
            FROM stockitems s
            WHERE s.StockItemID = ?
            ";
            $data = $this->pdo->prepare($query);
            $data->execute(array($product));
            $data = $data->fetch();

            // Zet de informatie in een Array zodat we er later makkelijk bij kunnen
            $orderline =
                [$product => [
                "product" => $product,
                "aantal" => $aantal,
                'product_naam' => $data['StockItemName'],
                'prijs_per' => $data['RecommendedRetailPrice']
                ]
            ];

            // Als de orderlines Array nog niet bestaat binnen de sessie, maak hem dan aan
            if(!isset($_SESSION['orderlines'])) {
                $_SESSION['orderlines'] = [];
            }

            //
            $_SESSION['orderlines'] = $orderline;

        }

        return $_SESSION['orderlines'][$product];

    }

}