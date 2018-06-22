<?php

namespace Lazada\OpenPlatform\Http;

abstract class AbstractHttp {
	// @var string Inherited Attributes from the API Client.
	public static $attributes;

	/**
	 * Handles any otherwise unavailable property accesses.
	 * 
	 * @param string $name Property Name
	 */
	public function __get($name) {
		if (array_key_exists($name, $this->attributes)) {
			return $this->attributes[$name];
		}

		return null;
	}

	/**
	 * Initialize the abstract class.
	 * 
	 * @param array $attributes Attributes from API Client
	 */
	public function __construct($attributes) {
		// set the application attributes
		$this->attributes = $attributes;
	}

	// classes from various extended classes
	abstract protected function get($path, $parameters);
	abstract protected function post($path, $parameters);
	abstract protected function getProperty($object, $properties);
}