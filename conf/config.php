<?php
$username = "root";
$password = "root";
$db = "mysql:host=localhost;dbname=wideworldimporters;port=8888";
try {
    $pdo = new PDO($db, $username, $password);
} catch (PDOException $p) {
    print('Error! ' . $p->getMessage());
}
// Global variables
$default_url = '/WWI/';