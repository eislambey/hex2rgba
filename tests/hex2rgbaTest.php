<?php

include __DIR__ . '/../src/hex2rgba.php';

class hex2rgbaTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testHex2rgba($hex, $alpha, $rgba)
    {
        $this->assertEquals($rgba, hex2rgba($hex, $alpha));
    }

    public function dataProvider()
    {
        return [
            ['#FFF', .3, 'rgba(255, 255, 255, .3)'],
            ['#FFFFFF', 1, 'rgba(255, 255, 255, 1)'],
            ['FFF', .5, 'rgba(255, 255, 255, .5)'],
            ['FFFFFF', 1, 'rgba(255, 255, 255, 1)'],
            ['#123', 1, 'rgba(18, 49, 35, 1)'],
            ['000000', 0, 'rgba(0, 0, 0, 0)'],
        ];
    }

    public function testLongHex()
    {
        $hex = "#1234567";
        $this->expectException(InvalidArgumentException::class);
        hex2rgba($hex);
    }

    public function testShortHex()
    {
        $hex = "#12";
        $this->expectException(InvalidArgumentException::class);
        hex2rgba($hex);
    }

    public function testAlphaGreaterThenOne()
    {
        $this->expectException(InvalidArgumentException::class);
        hex2rgba("fff", 1.1);
    }
}