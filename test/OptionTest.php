<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/7/2019
 * Time: 9:50 AM.
 */

namespace EastStore\Test;


use EasyStore\Options;
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    public function setUp(): void
    {
        Options::setOptions([]);
    }

    public function testDefaultValue()
    {
        $this->assertEquals(Options::getOptions('version'), '1.0');
        $this->assertEquals(Options::getOptions('timeout'), 15);
    }
}
