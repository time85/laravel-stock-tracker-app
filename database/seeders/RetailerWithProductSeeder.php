<?php

namespace Database\Seeders;


use App\Models\Product; 
use App\Models\Stock; 
use App\Models\Retailer; 
use Illuminate\Database\Seeder;

class RetailerWithProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $switch = Product::create(['name' => 'Nintendo Switch (Neon)']);
        $retailer = Retailer::create(['name' => 'Spar']);
        $retailer->addStock($switch, new Stock(
            [
                'product_identifier' => 123456,
                'price' => 349,
                'url' => 'https://www.spar.at/xyz/nintendo-switch',
                'in_stock' => false
            ]
        ));
    }
}
