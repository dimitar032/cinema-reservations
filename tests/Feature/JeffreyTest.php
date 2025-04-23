<?php

namespace Tests\Feature;

use App\JeffBook\Calculator;
use App\JeffBook\Addition;
use App\JeffBook\Multiplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JeffreyTest extends TestCase
{
    public $calc;

    public function setUp()
    {
        parent::setUp();

        $this->calc = new Calculator;
    }


    /** @test */
    public function test_default_is_zero()
    {
        $this->assertSame($this->calc->getResult(), 0);
    }

    /** @test */
    public function calculator_can_add()
    {
        $this->calc->setOperands(5, 5, 5);
        $this->calc->setOperation(new Addition);
        $result = $this->calc->calculate();
        $this->assertSame(15, $result);
    }

    /** @test */
    public function calculator_can_multiply()
    {
        $this->calc->setOperands(5, 5, 5);
        $this->calc->setOperation(new Multiplication);
        $result = $this->calc->calculate();
        $this->assertSame(125, $result);
    }

}
