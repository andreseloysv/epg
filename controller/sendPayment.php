<?php

session_start();
include_once './curl.php';
include_once '../model/payment.php';

class sendPayment {

    private $firstName = "";
    private $lastName = "";
    private $creditCardNumber = "";
    private $ccv = "";
    private $expiration_month = "";
    private $expiration_year = "";
    private $amount = "";

    function __construct($firstName, $lastName, $creditCardNumber, $ccv, $expiration_month, $expiration_year, $amount) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->creditCardNumber = $creditCardNumber;
        $this->ccv = $ccv;
        $this->expiration_month = $expiration_month;
        $this->expiration_year = $expiration_year;
        $this->amount = $amount;
    }

    function post() {
        $service_url = 'http://www.andreseloysv.com/epg/response.php';
        $curl = curl_init($service_url);
        $curl_post_data = array(
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'creditCardNumber' => $this->creditCardNumber,
            'ccv' => $this->ccv,
            'expiration_month' => $this->expiration_month,
            'expiration_year' => $this->expiration_year,
            'amount' => $this->amount
        );
        $sender = new curl($service_url, $curl_post_data);
        $result = $sender->post();
        return $result;
    }

    function decodePostValues() {
        $this->firstName = base64_decode($_POST['firstName']);
        $this->lastName = base64_decode($_POST['lastName']);
        $this->creditCardNumber = base64_decode($_POST['creditCardNumber']);
        $this->ccv = base64_decode($_POST['ccv']);
        $this->expiration_month = base64_decode($_POST['expiration_month']);
        $this->expiration_year = base64_decode($_POST['expiration_year']);
    }

}

function checkPostValues($post,$paymentValues) {
    return true;
    if (count($paymentValues) !== count($post)) {
        return false;
    }
    foreach ($post as $key => $value) {
        if (!empty($value)) {
            if (!in_array($key, $paymentValues)) {
                return false;
            }
        } else {
            return false;
        }
    }
    return true;
}

if (checkPostValues($_POST,array("firstName", "lastName", "creditCardNumber", "ccv", "expiration_month", "expiration_year", "amount"))) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $creditCardNumber = $_POST['creditCardNumber'];
    $ccv = $_POST['ccv'];
    $expiration_month = $_POST['expiration_month'];
    $expiration_year = $_POST['expiration_year'];
    $sendPayment = new sendPayment($firstName, $lastName, $creditCardNumber, $ccv, $expiration_month, $expiration_year, $amount);
    $result = $sendPayment->post();
    if ($result->result == "OK") {
        echo("<div style='color: #009114;font-weight: bold;font-size: medium;padding: 15px;'>Success</div>");
    } else {
        echo("<div style='color: red;font-weight: bold;font-size: medium;padding: 15px;'>Error: " . $result->resultMessage . "</div>");
    }
}else{
    echo("<div style='color: red;font-weight: bold;font-size: medium;padding: 15px;'>Error: Values fails</div>");
}

