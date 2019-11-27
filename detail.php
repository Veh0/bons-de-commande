<?php

$dsn = 'mysql:dbname=classicmodels;host=localhost;charset=UTF8';
$user = 'root';
$password = 'root';
$id = $_GET["id"];
$database =  new PDO($dsn, $user, $password);
$data_customer = $database->prepare("SELECT  customerName, contactFirstName, contactLastName, addressLine1, addressLine2, city FROM customers INNER JOIN orders ON customers.customerNumber = orders.customerNumber WHERE orderNumber = :id");
$data_product = $database->prepare("SELECT orderNumber, productName, priceEach, quantityOrdered, ROUND(quantityOrdered*priceEach,2) FROM orderdetails INNER JOIN products ON orderdetails.productCode = products.productCode WHERE orderNumber = :id ORDER BY orderNumber");
$data_montant = $database->prepare("SELECT orderNumber, ROUND(SUM(quantityOrdered*priceEach), 2) as totalht, (ROUND(SUM(quantityOrdered*priceEach), 2)*0.2) as tva, (ROUND(SUM(quantityOrdered*priceEach), 2)*0.2 + ROUND(SUM(quantityOrdered*priceEach), 2)) as totalttc FROM orderdetails WHERE orderNumber = :id GROUP BY orderNumber");


if (isset($id) && !empty($id)) {;
	$data_customer->execute(array("id" => $id));
	$result_customer = $data_customer->fetchAll();
	$data_product->execute(array("id" => $id));
	$result_product = $data_product->fetchAll();
	$data_montant->execute(array("id" => $id));
	$result_montant = $data_montant->fetchAll();
}
include('detail.phtml');

?>