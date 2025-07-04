<?php

namespace Tests\Unit\Support\ValueObjects;

use InvalidArgumentException;
use Support\ValueObjects\Price;
use Tests\TestCase;

class PriceTest extends TestCase
{
    public function test_all()
    {
        $price = Price::make(10000);

        $this->assertInstanceOf(Price::class, $price);

        $this->assertEquals(10000, $price->raw());
        $this->assertEquals(100, $price->value());
        $this->assertEquals('USD', $price->currency());
        $this->assertEquals('$', $price->symbol());
        $this->assertEquals('100 $', $price);

        $this->expectException(InvalidArgumentException::class);

        Price::make(-10000);
        Price::make(10000, 'EUR');
    }
}
