<?php

$username = "root";
$password = "";
$db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";

try {
    $pdo = new PDO($db, $username, $password);
} catch (PDOException $p) {
    print('Error! ' . $p->getMessage());
}
