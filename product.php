<?php

$dsn = 'mysql:dbname=classicmodels;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';


if (isset($_POST['barre']) && !empty($_POST['barre']) && file_exists($_POST['barre'])) {
	$database =  new PDO($dsn, $user, $password);
	$search = $_POST['barre'];
	$data = $database->prepare("SELECT productLine, productName, quantityInStock, MSRP FROM products WHERE productLine LIKE :search OR productName LIKE :search OR MSRP LIKE :search");
	$data->execute(array('search' => '%'.$search.'%' ));
	$result = $data->fetchAll();
} else {
	$database =  new PDO($dsn, $user, $password);
	$data = $database->query("SELECT productLine, productName, quantityInStock, MSRP FROM products ORDER BY productLine, MSRP DESC");
	$result = $data->fetchAll();
} 


include('product.phtml');

?>