<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_get_and_set_name(): void
    {
        $name = 'Test Product';
        $product = new Product;
        $product->setName($name);
        $this->assertEquals($name, $product->getName());
    }

    public function test_get_and_set_price(): void
    {
        $price = 99.99;
        $product = new Product;
        $product->setPrice($price);
        $this->assertEquals($price, $product->getPrice());
    }
}
