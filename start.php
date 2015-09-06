<?php
session_start();
include_once './model/payment.php';
$payment=new payment(350,"USD");
$_SESSION['$payment']=$payment;
?>