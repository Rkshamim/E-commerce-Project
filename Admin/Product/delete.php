<?php

spl_autoload_register(function ($class) {
    require '../classes/' . $class . '.php';
});


$id = $_GET['id'];

if (!isset($id) || $id == '') {
    header('Location: index.php');
}

$databaseClass = new Database();

$productClass = new Product($databaseClass->connect());

$result = $productClass->delete($id);

header('Location: index.php');