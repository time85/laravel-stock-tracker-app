<?php

namespace App\Models;

use App\Clients\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function addStock(Product $product, Stock $stock) {
        $stock->product_id = $product->id;
        $this->stock()->save($stock);
    }


    public function stock() {
        return $this->hasMany(Stock::class);
    }

    public function client() {
        return (new ClientFactory())->make($this);
    }


}
