<?php

namespace omegaalfa;

use iterable;
use IteratorAggregate;

class Collection implements IteratorAggregate
{

	/**
	 * @var mixed
	 */
	protected mixed $valuesGenerator;


	/**
	 * Collection constructor.
	 */
	protected function __construct() { }


	/**
	 * @param  iterable|array  $values
	 *
	 * @return static
	 */
	public static function fromIterable(iterable $values): static
	{
		return static::fromGenerator(static fn() => yield from $values);
	}


	/**
	 * @param  callable  $callback
	 *
	 * @return static
	 */
	public static function fromGenerator(callable $callback): static
	{
		$new = new static();
		$new->valuesGenerator = $callback;

		return $new;
	}


	/**
	 * @return iterable
	 */
	public function getIterator(): iterable
	{
		return ($this->valuesGenerator)();
	}


	/**
	 * @param  mixed  ...$items
	 *
	 * @return $this.
	 */
	public function add(...$items): static
	{
		return $this->append($items);
	}


	/**
	 * @param  iterable  ...$collections
	 *
	 * @return $this
	 */
	public function append(iterable ...$collections): static
	{
		return static::fromGenerator(function() use ($collections) {
			yield from ($this->valuesGenerator)();
			foreach($collections as $col) {
				yield from $col;
			}
		});
	}


	/**
	 * @param  callable  $fn
	 *
	 * @return $this
	 */
	public function map(callable $fn): static
	{
		return static::fromGenerator(function() use ($fn) {
			foreach(($this->valuesGenerator)() as $key => $val) {
				yield $key => $fn($val);
			}
		});
	}


	/**
	 * @param  callable  $fn
	 *
	 * @return $this
	 */
	public function filter(callable $fn): static
	{
		return static::fromGenerator(function() use ($fn) {
			foreach(($this->valuesGenerator)() as $key => $val) {
				if($fn($val)) {
					yield $key => $val;
				}
			}
		});
	}


	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return iterator_to_array($this, false);
	}
}