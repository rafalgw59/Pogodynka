<?php

use App\Entity\Measurement;
use PHPUnit\Framework\TestCase;

class fahrenheitTest extends TestCase{
    /**
     * @test
     */
    public function isConversionCorrect(): void{
        $measurement = new Measurement();
        $measurement->setTemperature(20);

        $fahrenheit = $measurement->getFahrenheit();
        $this->assertEquals(68,$fahrenheit);
    }
    /**
     * @test
     * @dataProvider provideTestData
     */
    public function ConversionTest($expected, $celsius): void{
        $measurement = new Measurement();
        $measurement->setTemperature($celsius);

        $fahrenheit = $measurement->getFahrenheit();
        $this->assertEquals($expected,$fahrenheit);
    }

    public function provideTestData()
{
    return [
        [
            50,
            10,
        ],
        [
            68,
            20,
        ],
        [
            86,
            30,
        ],
        [
            104,
            40,
        ],
        [
            122,
            50,
        ]
    ];
}
}