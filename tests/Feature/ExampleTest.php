<?php

namespace Tests\Feature;

use App\Models\Product; 
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
        //$retailer->hasStock($switch);

    }
}
