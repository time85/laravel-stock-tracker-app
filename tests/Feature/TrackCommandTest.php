<?php

namespace Tests\Feature;


use App\Models\Product; 
use App\Models\Stock; 
use App\Models\Retailer;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Support\Facades\Http; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{

    use RefreshDatabase;

    /** @test  */
    function it_tracks_product_stock() {

        $this->seed(RetailerWithProductSeeder::class);
        $this->assertFalse(Product::first()->inStock());
        Http::fake(fn() => ['available' => true,'price' => 299]);
        $this->artisan('track');

        $this->assertTrue(Product::first()->inStock());
    }
}
