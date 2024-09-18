<?php

spl_autoload_register(function ($class) {
    require '../classes/' . $class . '.php';
});

$id = $_GET['id'];

if (!isset($id) || $id == '') {
    header('Location: index.php');
}

$databaseClass = new Database();

$customerClass = new Customer($databaseClass->connect());

$result = $customerClass->delete($id);

if($result) {
    $_SESSION['success'] = 'Customer deleted successfully';
}else {
    $_SESSION['error'] = 'Something went wrong';
}

header('Location: index.php');