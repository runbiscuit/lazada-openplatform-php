<?php

namespace Lazada\OpenPlatform\Exceptions;

use Exception;

class EndpointException extends Exception {
	// @var array Lookup Table of Possible Endpoint Exceptions.
	public static $exceptions;

	/**
	 * Initialize the EndpointException.
	 * 
	 * @param string $message Exception Message
	 * @param integer $code Exception Code
	 */
	public function __construct($message, $code) {
		// set the lookup table of possible endpoint exceptions.
		$this->exceptions = [
			'Unknown Error',
			'Invalid Endpoint ID',
			'Validation Error',
			'Endpoint Error'
		];

		parent::__construct($message, $code, null);
	}

	/**
	 * Return a String Representation of Exception.
	 * 
	 * @return string Exception, in plaintext
	 */
	public function __toString() {
		return $this->exceptions[$code] . ': ' . $message;
	}
}