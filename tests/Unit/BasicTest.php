<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    public function test_aplicacion_funciona()
    {
        $this->assertTrue(true);
    }

    public function test_stock_no_puede_ser_negativo()
    {
        $stockValido = 10;
        $stockInvalido = -5;
        
        $this->assertGreaterThanOrEqual(0, $stockValido);
        $this->assertLessThan(0, $stockInvalido);
    }

    public function test_precio_debe_ser_numerico()
    {
        $precio = 1500.50;

        $this->assertIsNumeric($precio);
        $this->assertGreaterThan(0, $precio);
    }
}
