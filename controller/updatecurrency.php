<?php

include_once '../model/payment.php';
session_start();
$payment = $_SESSION['$payment'];
$payment->chagenCurrency($_GET["currencyName"]);
echo($payment->getTotalAmount());
?>