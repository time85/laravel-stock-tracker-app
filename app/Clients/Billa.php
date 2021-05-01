<?php

namespace App\Clients;


use Illuminate\Support\Facades\Http;
use App\Models\Stock;


class Billa implements Client{
    public function checkAvailability(Stock $stock) :StockAvailabilityResponse {
        $result = Http::get('http://api.foo.com')->json();
        return new StockAvailabilityResponse(
            $result['available'],
            $result['price']
        );
    }
}