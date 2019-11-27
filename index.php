<?php

$dsn = 'mysql:dbname=classicmodels;host=localhost';
$user = 'root';
$password = 'root';

$database =  new PDO($dsn, $user, $password);
$data = $database->query("SELECT orderNumber, orderDate, requiredDate, status FROM orders WHERE orderDate LIKE '2003%' AND status = 'Shipped' ORDER BY orderNumber");
$result = $data->fetchAll();

include('index.phtml');

?>