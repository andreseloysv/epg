<?php

class currency {

    public $id = "";
    private $name = "";
    private $date = "";
    private $rate = "";

    function __construct($id, $name, $rate, $date) {
        $this->id=$id;
        $this->name = $name;
        $this->rate = $rate;
        $this->date = $date;
    }
    public function getRate(){
        return $this->rate;
    }
    

}

?>