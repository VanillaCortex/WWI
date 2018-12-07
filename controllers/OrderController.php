<?php

global $pdo;

class Order
{

    private $pdo;

    function __construct()
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/WWI/conf/config.php';
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getOrders()
    {

        // Check of de gebruiker ingelogd is, zo niet dan heeft hij/zij hier niks te zoeken
        if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {
            echo '<script>window.location.replace("/WWI");</script>';
            die;
        }

        if(isset($_SESSION) && !empty($_SESSION)) {

            $user_id = $_SESSION['user_id'];

            $query = "SELECT * FROM orders_temp WHERE user_id = ?";
            $orders = $this->pdo->prepare($query);
            $orders->bindParam(1, $user_id);

        }

    }

    public function showOrder()
    {

    }

    public function create()
    {

        // Check of de gebruiker ingelogd is, zo niet dan heeft hij/zij hier niks te zoeken
        if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0) {

            // Maak een compleet random wachtwoor aan voor de gebruiker, als deze dus nog geen account heeft
            $rand_password = password_hash((random_int(100, 999) * random_int(100, 999)), PASSWORD_DEFAULT);

            // Maak een account aan voor de gebruiker
            $user = $this->pdo->prepare("INSERT INTO users (naam, email, password) values(?, ?, ?)");
            $user->bindParam(1, $_POST['firstname']);
            $user->bindParam(2, $_POST['email']);
            $user->bindParam(3, $rand_password);
            $user->execute();

            // Haal gelijk het ID op van onze aangemaakte user
            $latest_user = $this->pdo->lastInsertId();

            // We proberen de queries deze keer in een try block
            try {

                // Maak een order aan voor de gebruiker
                $order = $this->pdo->prepare("INSERT INTO orders_temp (user_id) values(?)");
                $order->bindParam(1, $latest_user);
                $order->execute();

                // Haal gelijk weer het ID op voor onze order en tel hier 1 bij op
                $order_id = $this->pdo->lastInsertId();

                // Maak elke orderline aan
                foreach($_SESSION['orderlines'] as $orderline) {

                    // Haal de laatste orderlineID op en tel hier ééntje bij op
                    $orderline_id = "SELECT max(OrderLineID) FROM orderlines";
                    $data_2 = $this->pdo->prepare($orderline_id);
                    $data_2->execute();
                    $data_2 = $data_2->fetch();
                    $max_orderline_id = $data_2[0] + 1;

                    // Gooi alle waardes die we nu hebben in de orderline
                    $query = "INSERT INTO orderlines (OrderLineID, OrderID, StockItemID, Description, PackageTypeID, Quantity, UnitPrice, TaxRate, PickedQuantity, PickingCompletedWhen, LastEditedBy, LastEditedWhen)
                              values(?, ?, ?, ?, ?, ?, ?, ?, ?  , NOW(), 1, NOW())";
                    $new_orderline = $this->pdo->prepare($query);
                    $new_orderline->bindParam(1, $max_orderline_id, PDO::PARAM_INT);
                    $new_orderline->bindParam(2, $order_id, PDO::PARAM_INT);
                    $new_orderline->bindParam(3, $orderline['product'], PDO::PARAM_INT);
                    $new_orderline->bindParam(4, $orderline['product_naam'], PDO::PARAM_STR);
                    $new_orderline->bindParam(5, $orderline['UnitPackageID'], PDO::PARAM_INT);
                    $new_orderline->bindParam(6, $orderline['aantal'], PDO::PARAM_INT);
                    $new_orderline->bindParam(7, $orderline['UnitPrice'], PDO::PARAM_INT);
                    $new_orderline->bindParam(8, $orderline['TaxRate'], PDO::PARAM_INT);
                    $new_orderline->bindParam(9, $orderline['aantal'], PDO::PARAM_INT);
                    $new_orderline->execute();

                }

                // Als het goed is gegaan dan gaan we nu naar de success pagina
                echo '<script>window.location.replace("/WWI/pay");</script>';
                unset($_SESSION['orderlines']);
                die;

            } catch (PDOException $e) {
                // Als het fout gaat gaan we terug naar de homepage
                echo '<script>window.location.replace("/WWI");</script>';
                die;
            }

        }

        // Als de sessie gezet is
        if(isset($_SESSION) && !empty($_SESSION)) {

            // We proberen de queries deze keer in een try block
            try {

                // Maak een order aan voor de gebruiker
                $order = $this->pdo->prepare("INSERT INTO orders_temp (user_id) values(?)");
                $order->bindParam(1, $_SESSION['user_id']);
                $order->execute();

                // Haal gelijk weer het ID op voor onze order en tel hier 1 bij op
                $order_id = $this->pdo->lastInsertId();

                // Maak elke orderline aan
                foreach($_SESSION['orderlines'] as $orderline) {

                    // Haal de laatste orderlineID op en tel hier ééntje bij op
                    $orderline_id = "SELECT max(OrderLineID) FROM orderlines";
                    $data_2 = $this->pdo->prepare($orderline_id);
                    $data_2->execute();
                    $data_2 = $data_2->fetch();
                    $max_orderline_id = $data_2[0] + 1;

                    // Gooi alle waardes die we nu hebben in de orderline
                    $query = "INSERT INTO orderlines (OrderLineID, OrderID, StockItemID, Description, PackageTypeID, Quantity, UnitPrice, TaxRate, PickedQuantity, PickingCompletedWhen, LastEditedBy, LastEditedWhen)
                              values(?, ?, ?, ?, ?, ?, ?, ?, ?  , NOW(), 1, NOW())";
                    $new_orderline = $this->pdo->prepare($query);
                    $new_orderline->bindParam(1, $max_orderline_id, PDO::PARAM_INT);
                    $new_orderline->bindParam(2, $order_id, PDO::PARAM_INT);
                    $new_orderline->bindParam(3, $orderline['product'], PDO::PARAM_INT);
                    $new_orderline->bindParam(4, $orderline['product_naam'], PDO::PARAM_STR);
                    $new_orderline->bindParam(5, $orderline['UnitPackageID'], PDO::PARAM_INT);
                    $new_orderline->bindParam(6, $orderline['aantal'], PDO::PARAM_INT);
                    $new_orderline->bindParam(7, $orderline['UnitPrice'], PDO::PARAM_INT);
                    $new_orderline->bindParam(8, $orderline['TaxRate'], PDO::PARAM_INT);
                    $new_orderline->bindParam(9, $orderline['aantal'], PDO::PARAM_INT);
                    $new_orderline->execute();

                }

                // Als het goed is gegaan dan gaan we nu naar de success pagina
                echo '<script>window.location.replace("/WWI/pay");</script>';
                unset($_SESSION['orderlines']);
                die;

            } catch (PDOException $e) {
                // Als het fout gaat gaan we terug naar de homepage
                echo '<script>window.location.replace("/WWI");</script>';
            }

        }

        return 'completed';

    }

}