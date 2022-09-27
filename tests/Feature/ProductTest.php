<?php

namespace Tests\Feature;

use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_main_route()
    {
        $response = $this->get('api/');

        $response->assertStatus(200);
    }

    public function test_get_products()
    {
        $response = $this->get('api/products');

        $response->assertStatus(200);
    }

    public function test_get_product()
    {
        $response = $this->get("api/products/3017620422003");

        $response->assertStatus(200);
    }
}
