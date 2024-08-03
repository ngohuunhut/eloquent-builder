<?php

namespace Nhn\EloquentBuilder\Tests;

use Tests\TestCase;
use Str;

class BoilerplateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddMacroNhnSuccessful()
    {
        $this->assertTrue(Str::hasMacro('nhn'));
    }

    public function testMacroNhnWorkSuccessful()
    {
        $value = "Hello!!!";

        $this->assertEquals(Str::nhn($value), $value);
    }
}
