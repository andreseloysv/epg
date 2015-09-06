<?php

include_once '../model/currency.php';

class currencyController {

    private $currency;

    function __construct() {
        
    }

    function getCurrencyById($id) {
        
    }

    function getCurrencyByName($name) {
        
    }
    
    function getListCurrency() {
        $USD = new currency(1, "USD", 1, '2015-09-08 16:45');
        $EUR = new currency(2, "EUR", 1.1234, '2015-09-08 16:45');
        $list[0] = $USD;
        $list[1] = $EUR;
        return json_encode($list);
    }
    function getAmount($price,$curremcy){
        
    }

}
$currencyController = new currencyController();
$currencyController->getAmount($_POST['price'], $_POST['currency']);
?>