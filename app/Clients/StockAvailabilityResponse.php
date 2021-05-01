<?php

namespace App\Clients;

class StockAvailabilityResponse {
    public $available;
    public $price;

    public function __construct($available, $price) 
    {
        $this->available = $available;
        $this->price = $price;
    }

}