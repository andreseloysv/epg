<?php

class card {

    private $id = "";
    private $creditCardNumber = "";
    private $cvv = "";
    private $expiration_month = "";
    private $expiration_year = "";
    

    function __construct($creditCardNumber, $ccv, $expiration_month, $expiration_year, $amount) {
        $this->id=$id;
        $this->creditCardNumber=$creditCardNumber;
        $this->cvv=$ccv;
        $this->expiration_month=$expiration_month;
        $this->expiration_year=$expiration_year;
    }    
    
}

?>