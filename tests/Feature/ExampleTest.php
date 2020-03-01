<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new order.
     *
     * @return void
     */
    public function testCreatingANewOrder()
    {
        // Run the DatabaseSeeder...
        //$this->seed();

        // Run a single seeder...
        $this->seed(OrderStatusesTableSeeder::class);

        // ...
    }
}
