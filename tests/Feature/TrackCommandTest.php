<?php

namespace Tests\Feature;


use App\Models\Product; 
use App\Models\Stock; 
use App\Models\Retailer; 

use Illuminate\Support\Facades\Http; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{

    use RefreshDatabase;

    /** @test  */
    function it_tracks_product_stock() {
        $switch = Product::create(['name' => 'Nintendo Switch (Neon)']);
        $retailer = Retailer::create(['name' => 'Spar']);
        $stock = new Stock(
            [
                'product_identifier' => 123456,
                'price' => 349,
                'url' => 'https://www.spar.at/xyz/nintendo-switch',
                'in_stock' => false
            ]
        );

        $this->assertFalse($stock->in_stock);
        $retailer->addStock($switch, $stock);

        Http::fake(function() {
            return [
                'available' => true,
                'price' => 299
            ];
        });
        $this->artisan('track');

        $this->assertTrue($stock->fresh()->in_stock);
    }
}
