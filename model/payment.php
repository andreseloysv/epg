<?php

include_once '/home/andreslaley/public_html/epg/model/payer.php';
include_once '/home/andreslaley/public_html/epg/model/card.php';
include_once '/home/andreslaley/public_html/epg/model/currency.php';

class payment {

    private $id = "";
    private $date = "";
    private $result_message = "";
    private $result_code = "";
    private $result = "";
    private $payer;
    private $card;
    public $currency;
    public $amount;
    public $totalAmount;

    function __construct($amount, $currency_name) {
        $this->amount = $amount;
        $this->currency = new currency("1", $currency_name, 1, "2015-09-08 16:45");
    }

    function getCurrencyList() {
        $USD = new currency(1, "USD", 1, '2015-09-08 16:45');
        $EUR = new currency(2, "EUR", 1.1234, '2015-09-08 16:45');
        $list["USD"] = $USD;
        $list["EUR"] = $EUR;
        return $list;
    }

    function getCurrency($name) {
        $USD = new currency(1, "USD", 1, '2015-09-08 16:45');
        $EUR = new currency(2, "EUR", 1.1234, '2015-09-08 16:45');
        $list["USD"] = $USD;
        $list["EUR"] = $EUR;
        return $list[$name];
    }

    function getAmount() {
        return $this->amount;
    }

    public function getTotalAmount() {
        $this->totalAmount = $this->amount * $this->currency->getRate();
        return $this->totalAmount;
    }

    function chagenCurrency($name) {
        $this->currency = $this->getCurrency($name);
    }

    function savePayment($id, $result_code, $result, $result_message, $id_payer, $firstName, $lastName, $id_card, $creditCardNumber, $ccv, $expiration_month, $expiration_year, $amount) {
        $this->id = $id;
        $this->result_message = $result_message;
        $this->result_code = $result_code;
        $this->result = $result;
        $this->payer = new payer($id_payer, $firstName, $lastName);
        $this->card = new card($id_card, $creditCardNumber, $ccv, $expiration_month, $expiration_year, $amount);
    }

}

?>