<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
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
        $results = Http::get('http://api.foo.com')->json();
        $this->update([
            'in_stock' => $results['available'],
            'price' => $results['price']
        ]);
    }

    public function retailer() {
        return $this->belongsTo(Retailer::class);
    }
}
