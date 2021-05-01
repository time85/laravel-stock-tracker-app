<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['product_identifier', 'price', 'url', 'in_stock'];
    
    protected $casts = [
        'in_stock' => 'boolean'
    ];
    
    public function track() {

        $objStockAvailability =  $this->retailer->client()->checkAvailability($this);
    
        $this->update([
            'in_stock' => $objStockAvailability->available,
            'price' => $objStockAvailability->price
        ]);

    }

    public function retailer() {
        return $this->belongsTo(Retailer::class);
    }

    private function checkAvailability(Retailer $retailer) {

    }

}
