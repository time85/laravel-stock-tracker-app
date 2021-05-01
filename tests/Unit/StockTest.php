<?php

namespace Tests\Unit;

use App\Models\Stock;
use App\Models\Retailer;
use Tests\TestCase;
use Database\Seeders\RetailerWithProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockTest extends TestCase
{
    use RefreshDatabase; 
    
    /** @test */
    public function it_throws_an_exception_if_a_client_is_not_found_when_tracking()
    {
        $this->seed(RetailerWithProductSeeder::class);

        Retailer::first()->update(['name' => 'Foo Exception Retailer']);

        $this->expectException(\Exception::class);


        Stock::first()->track();

       
    }
}
