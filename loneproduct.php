<?php

$dsn = 'mysql:dbname=classicmodels;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$product = $_GET['product'];

if (isset($_POST['barre']) && !empty($_POST['barre'])) {
	$database =  new PDO($dsn, $user, $password);
	$search = $_POST['barre'];
	$data = $database->prepare("SELECT productLine, productName, quantityInStock, MSRP FROM products WHERE productLine = :product AND productName LIKE :search OR MSRP LIKE :search");
	$data->execute(array('search' => '%'.$search.'%', "product" => $product));
	$result = $data->fetchAll();
} else {
	$database =  new PDO($dsn, $user, $password);
	$data = $database->prepare("SELECT productLine, productName, quantityInStock, MSRP FROM products WHERE productLine = :product ORDER BY MSRP DESC");
	$data->execute(array("product" => $product));
	$result = $data->fetchAll();
}


include('loneproduct.phtml');

?>