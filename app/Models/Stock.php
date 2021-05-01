<?php

namespace App\Models;

use Illuminate\Support\Str;
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


        $className = '\\App\Clients\\' . Str::studly($this->retailer->name);

        if (!class_exists($className)) {
            throw new \Exception('Unknown Client. Tracking not possible');
        }

        $objStockAvailability = (new $className)->checkAvailability($this);

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
