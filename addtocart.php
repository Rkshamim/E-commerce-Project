


<?php
session_start();

spl_autoload_register(function ($class) {
    require './admin/classes/' . $class . '.php';
});

$productId = $_GET['id'];

if (!isset($productId) || $productId == '') {
    header('Location: index.php');
}

$customerId = isset($_SESSION['current_customer']) ? $_SESSION['current_customer']['id'] : 0;

$databaseClass = new Database();

$cartClass = new Cart($databaseClass->connect());

$products = $cartClass->addCart($productId);

header('Location: index.php');


