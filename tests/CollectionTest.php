<?php

namespace omegaalfa\Tests;

use omegaalfa\Collection\Arr;
use omegaalfa\Collection\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testFromIterable(): void
    {
        $collection = Collection::fromIterable([1, 2, 3]);
        $result = $collection->toArray();

        $this->assertEquals([1, 2, 3], $result);
    }

    public function testFromGenerator(): void
    {
        $collection = Collection::fromGenerator(static function () {
            yield 1;
            yield 2;
            yield 3;
        });

        $result = $collection->toArray();

        $this->assertEquals([1, 2, 3], $result);
    }

    public function testGetIterator(): void
    {
        $collection = Collection::fromIterable([1, 2, 3]);
        $iterator = $collection->getIterator();

        $this->assertInstanceOf(\Traversable::class, $iterator);
    }

    public function testAdd(): void
    {
        $collection = Collection::fromIterable([1, 2, 3]);
        $result = $collection->add(4, 5)->toArray();

        $this->assertEquals([1, 2, 3, 4, 5], $result);
    }

    public function testAppend(): void
    {
        $collection1 = Collection::fromIterable([1, 2, 3]);
        $collection2 = Collection::fromIterable([4, 5, 6]);
        $result = $collection1->append($collection2)->toArray();

        $this->assertEquals([1, 2, 3, 4, 5, 6], $result);
    }

    public function testMap(): void
    {
        $collection = Collection::fromIterable([1, 2, 3]);
        $result = $collection->map(fn($item) => $item * 2)->toArray();

        $this->assertEquals([2, 4, 6], $result);
    }

    public function testFilter(): void
    {
        $collection = Collection::fromIterable([1, 2, 3, 4, 5]);
        $result = $collection->filter(fn($item) => $item % 2 === 0)->toArray();

        $this->assertEquals([2, 4], $result);
    }

    public function testToArray(): void
    {
        $collection = Collection::fromIterable(['a' => 1, 'b' => 2, 'c' => 3]);
        $result = $collection->toArray();

        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3], $result);
    }
}
