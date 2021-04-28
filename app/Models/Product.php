<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    public function inStock() : bool {
        return $this->stock()->where('in_stock', true)->exists();
    }

    public function stock() {
        return $this->hasMany(Stock::class);
    }

    public function track() {
        $this->stock->each->track();
    }

}
