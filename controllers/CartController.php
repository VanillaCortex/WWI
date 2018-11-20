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
            $orderline = [
                "product" => $product,
                "aantal" => $aantal,
                'product_naam' => $data['StockItemName'],
                'prijs_per' => $data['RecommendedRetailPrice']
            ];

            // Als de orderlines Array nog niet bestaat binnen de sessie, maak hem dan aan
            if(!isset($_SESSION['orderlines'])) {
                $_SESSION['orderlines'] = [];
            }

            //
            $_SESSION['orderlines'][$product] = $orderline;

        }

        return $_SESSION['orderlines'][$product];

    }

    public function getCart() {

        // Check of de session wel gezit is, zo niet dan geef geen cart weer
        if(session_status() == PHP_SESSION_NONE) {
            return('Geen producten in de winkelmand');
        }

        // Check of de orderlines al bestaan, oftwel of de gebruikeer uberhaupt wel een product heeft toegevoegd
        if(isset($_SESSION['orderlines']) && !empty($_SESSION['orderlines'])) {

            // Zet de variable alvast
            $total = 0;

            //@todo werk totaal hier weg
            // Loop door alle items heen om het totaal te berekenen
            foreach($_SESSION['orderlines'] as $product) {

                // Telt het totaal van de prijs bij elkaar op
                $total += ($product['prijs_per'] * $product['aantal']);

            }

//            if(count($_SESSION['orderlines']) === 1 && isset($_SESSION['orderlines']['total_prijs']) && $_SESSION['orderlines']['totaal_prijs'] === 0) {
//                unset($_SESSION['orderlines']);
//                return('Geen producten in de winkelmand!');
//            }

            // Zet het totaal in de sessie
            $_SESSION['orderlines']['totaal_prijs'] = $total;

            // Return the orderlines
            return($_SESSION['orderlines']);

        }

        // Als de orderlines nog niet bestaan geef dan weer dezelfde melding weer
        return('Geen producten in de winkelmand!');

    }

    public function removeLineFromCart($id)
    {

        // Check of de sessie bestaat en niet leeg is
        if(isset($_SESSION) && !empty($_SESSION)) {

            // Unset/verwijderen de orderline die we verwijderd willen hebben
            unset($_SESSION['orderlines'][$id]);

            // refresh de pagina/redirect naar de cart
            header('Location: /WWI/cart');

        } else {
            // Als hij niet bestaat of leeg is return null zodat er niks mee gebeurd
            return null;
        }

    }

    public function updateAantal($id, $aantal)
    {

        // Check of de sessie bestaat en niet leeg is
        if(isset($_SESSION) && !empty($_SESSION)) {

            $_SESSION['orderlines'][$id]['aantal'] = $aantal;

            header('Location: /WWI/cart');

        } else {

            return null;

        }

    }

}