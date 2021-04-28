<?php

namespace Tests\Feature;

use App\Models\Product; 
use App\Models\Stock; 
use App\Models\Retailer; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_checks_stocks_for_products_as_retailers()
    {
        $switch = Product::create(['name' => 'Nintendo Switch (Neon)']);

        $retailer = Retailer::create(['name' => 'Spar']);

        $this->assertFalse($switch->inStock());


        $stock = new Stock(
            [
                'product_identifier' => 123456,
                'price' => 349,
                'url' => 'https://www.spar.at/xyz/nintendo-switch',
                'in_stock' => true
            ]
        );

        $retailer->addStock($switch, $stock);

        $this->assertTrue($switch->inStock());

    }
}
