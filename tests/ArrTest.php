<?php

namespace omegaalfa\Tests;

use omegaalfa\Collection\Arr;
use PHPUnit\Framework\TestCase;

class ArrTest extends TestCase
{
    public function testSearchInArray(): void
    {
        $array = ['foo' => ['bar' => 'baz']];
        $result = Arr::searchInArray($array, 'foo.bar');
        $this->assertEquals('baz', $result);

        $resultDefault = Arr::searchInArray($array, 'not.exists', 'default');
        $this->assertEquals('default', $resultDefault);
    }

    public function testIsEmptyAssoc(): void
    {
        $emptyArray = [];
        $notEmptyArray = ['key' => 'value'];

        $this->assertTrue(Arr::isEmptyAssoc($emptyArray));
        $this->assertFalse(Arr::isEmptyAssoc($notEmptyArray));
    }

    public function testValueInArray(): void
    {
        $array = ['apple', 'banana', 'cherry'];

        $this->assertTrue(Arr::valueInArray($array, 'banana'));
        $this->assertFalse(Arr::valueInArray($array, 'grape'));
    }

    public function testArrayKeysValues(): void
    {
        $array = ['a' => 1, 'b' => false, 'c' => 3, 'd' => null];
        $result = Arr::arrayKeysValues($array);

        $this->assertEquals(['a' => 1, 'c' => 3], $result);
    }

    public function testCombine(): void
    {
        $keys = ['a', 'b', 'c'];
        $values = [1, 2, 3];
        $result = Arr::combine($keys, $values);

        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3], $result);
    }

    public function testSet(): void
    {
        $array = [];
        Arr::set($array, 'key', 'value');

        $this->assertEquals(['key' => 'value'], $array);
    }

    public function testGet(): void
    {
        $array = ['key' => 'value'];
        $result = Arr::get($array, 'key');

        $this->assertEquals('value', $result);

        $resultDefault = Arr::get($array, 'not.exists', 'default');
        $this->assertEquals('default', $resultDefault);
    }

    public function testKeyInArray(): void
    {
        $array = ['key' => 'value'];

        $this->assertTrue(Arr::keyInArray($array, 'key'));
        $this->assertFalse(Arr::keyInArray($array, 'not.exists'));
    }

    public function testEncodeJson(): void
    {
        $array = ['key' => 'value'];
        $result = Arr::encodeJson($array);

        $this->assertEquals('{"key":"value"}', $result);
    }

    public function testDecodeJson(): void
    {
        $json = '{"key":"value"}';
        $result = Arr::decodeJson($json);

        $this->assertEquals(['key' => 'value'], $result);
    }

    public function testEach(): void
    {
        $array = ['a' => 1, 'b' => 2, 'c' => 3];
		$newArray = [];

	    Arr::each($array, static function ($item, $key) use (&$newArray) {
		    $newArray[$key] = $item * 2;
        });

	    $this->assertEquals(['a' => 2, 'b' => 4, 'c' => 6], $newArray);
    }
}
