<?php

namespace Lazada\OpenPlatform\Authentication;

abstract class AbstractAuthentication {
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
	abstract protected function authorize($state = null, $uuid = null, $country = null);

	abstract protected function getAccessToken($code);
	abstract protected function renewAccessToken($refreshToken);
}