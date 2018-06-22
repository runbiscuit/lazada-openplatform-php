<?php

namespace Lazada\OpenPlatform\Exceptions;

use Exception;

class AuthorizationException extends Exception {
	// @var array Lookup Table of Possible Endpoint Exceptions.
	public static $exceptions;

	/**
	 * Initialize the AuthorizationException.
	 * 
	 * @param string $message Exception Message
	 * @param integer $code Exception Code
	 */
	public function __construct($message, $code) {
		// set the lookup table of possible endpoint exceptions.
		$this->exceptions = [
			'Unknown error',
			'Invalid callback URL'
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