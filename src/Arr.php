<?php

namespace omegaalfa;

use Exception;

class Arr extends Collection
{

	/**
	 * @var array
	 */
	public static array $array;


	/**
	 * @param  array       $array
	 * @param  mixed       $value
	 * @param  mixed|null  $default
	 *
	 * @return mixed
	 */
	public static function searchInArray(array $array, mixed $value, mixed $default = null): mixed
	{

		if(!is_array($value)) {
			$value = explode('.', $value);
		}

		$data = self::fromIterable($value);

		foreach($data as $piece) {
			if(!array_key_exists($piece, $array)) {
				return $default;
			}

			$array = $array[$piece];
		}

		return $array;
	}

	/**
	 * @param  array  $array
	 *
	 * @return bool
	 */
	public static function isEmptyAssoc(array $array): bool
	{
		if(!empty(array_filter($array))) {
			return false;
		}

		return true;
	}

	/**
	 * @param  array   $array
	 * @param  string  $value
	 *
	 * @return bool
	 */
	public static function valueInArray(array $array, string $value): bool
	{
		return in_array($value, $array, true);
	}

	/**
	 * @param  array  $array
	 *
	 * @return array
	 */
	public static function arrayKeysValues(array $array): array
	{
		foreach($array as $key => $value) {
			if($value) {
				self::$array[$key] = $value;
			}
		}

		return self::$array;
	}

	/**
	 * @param  array  $keys
	 * @param  array  $values
	 *
	 * @return array
	 */
	public static function combine(array $keys, array $values): array
	{
		array_walk($keys, static fn($index) => self::$array[$index] = $values);

		return self::$array;
	}

	/**
	 * @param  array  $array
	 * @param         $key
	 * @param         $value
	 */
	public static function set(array &$array, $key, $value): void
	{
		array_push($array, $key, $value);
	}

	/**
	 * @param  array   $array
	 * @param  string  $key
	 *
	 * @return mixed
	 */
	public static function get(array $array, string $key): mixed
	{
		if(self::keyInArray($array, $key)) {
			return $array[$key];
		}

		return null;
	}

	/**
	 * @param  array   $array
	 * @param  string  $key
	 *
	 * @return bool
	 */
	public static function keyInArray(array $array, string $key): bool
	{
		return array_key_exists($key, $array);
	}

	/**
	 * @param  array  $array
	 *
	 * @return false|string
	 */
	public static function encodeJson(array $array): bool|string
	{
		try {
			return json_encode($array, JSON_THROW_ON_ERROR);
		} catch(Exception) {
			return false;
		}
	}

	public static function decodeJson(string $json)
	{
		try {
			return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
		} catch(Exception) {
			return false;
		}
	}

	/**
	 * @param  array     $array
	 * @param  callable  $callback
	 *
	 * @return Arr
	 */
	public static function each(array $array, callable $callback): Arr
	{
		$arr = self::fromIterable($array);

		foreach($arr as $key => $item) {
			if($callback($item, $key) === false) {
				break;
			}
		}

		return $arr;
	}

}
