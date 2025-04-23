<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{

    //********************** SetUp(DRY) **********************

//    protected $product;
//
//    public function setUp()
//    {
//        $this->product = new Product('Fallout 4', 59);
//    }
//
//    /** @test */
//    public function a_product_has_a_name()
//    {
//        $this->assertEquals('Fallout 4', $this->product->name);
//    }
//
//    /** @test */
//    public function a_product_has_a_cost()
//    {
//        $this->assertEquals(59, $this->product->price);
//    }
    //********************** SetUp(DRY) E N D **********************

    //********************** Depends **********************
    public function testProducerFirst()
    {
        $this->assertTrue(true);
        return 'first';
    }

    public function testProducerSecond()
    {
        $this->assertTrue(true);
        return 'second';
    }

    /**
     * @depends testProducerFirst
     * @depends testProducerSecond
     */
    public function testConsumer()
    {
        $this->assertEquals(
            ['first', 'second'],
            func_get_args()
        );
    }
    //********************** Depends E N D **********************

    //********************** Data Providers **********************
    /**
     * @dataProvider additionProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }

    public function additionProvider()
    {
        return [
            'adding zeros' => [0, 0, 0],
            'zero plus one' => [0, 1, 1],
            'one plus zero' => [1, 0, 1],
//            'one plus one'  => [1, 1, 3]
        ];
    }
    //********************** Data Providers E N D**********************

    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);

    }
}
