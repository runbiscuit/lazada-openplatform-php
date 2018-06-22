<?php

namespace Lazada\OpenPlatform\Objects\Order;

abstract class AbstractOrder {
	// @var string Inherited Attributes from the API Client.
	public static $attributes;

	// @var Possible Order Statuses
	public static $statuses = [ 'pending', 'canceled', 'ready_to_ship', 'delivered', 'returned', 'shipped', 'failed' ];

	// @var Possible Sorting Directions
	public static $sortingDirections = [ 'ASC', 'DESC' ];

	// @var Possible Sorting Values
	public static $sortingValues = [ 'created_at', 'updated_at' ];

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
}