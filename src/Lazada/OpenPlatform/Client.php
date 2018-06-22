<?php

namespace Lazada\OpenPlatform;

use Lazada\OpenPlatform\Exceptions\EndpointException;

use Lazada\OpenPlatform\Http\AbstractHttp;

class Client {
	// @var string The Lazada Open Platform Authentication Base URL.
	public static $authenticationBaseURL = 'https://auth.lazada.com';

	// @var string The Application Key used to identify Open Platform requests.
	public static $key = '';

	// @var string The Application Secret used to generate Open Platform requests.
	public static $secret = '';

	// @var string The Lazada Venture contacted through this Rest API Client.
	public static $venture = '';

	// @var string The Lazada Open Platform Base URL (default: Singapore).
	public static $baseURL = 'https://api.lazada.sg/rest';

	// @var string Your Application Callback URL.
	public static $callbackURL = '';

	// @var string Your User Access Token.
	public static $accessToken = '';

	// @var class HTTP Client
	public static $http;

	/**
	 * Handles the calling of lower depth properties.
	 * Allows for calls like $client->auth->authorize().
	 * 
	 * @param string $name Name of Property
	 */
	public function __get($name) {
		if (array_key_exists($name, $this->methods)) {
			return new $this->methods[$name](get_object_vars($this));
		}
	}

	/**
	 * Initialize the Rest API Client.
	 * 
	 * @param string $key Application Key
	 * @param string $secret Application Secret
	 * @param string $venture Lazada Venture ID
	 * @param string|null $callbackURL Callback URL
	 * @param array|null $overrides Overrides
	 */
	public function __construct($key, $secret, $venture, $callbackURL = null, $overrides = []) {
		// set the array with keys for various classes
		$this->methods = [
			'auth' => __NAMESPACE__ . '\Authentication\AbstractAuthentication',
			'http' => __NAMESPACE__ . '\Http\AbstractHttp',

			'order' => __NAMESPACE__ . '\Objects\Order\AbstractOrder',
			'product' => __NAMESPACE__ . '\Objects\Product\AbstractProduct',
			'finance' => __NAMESPACE__ . '\Objects\Finance\AbstractFinance',
			'logistics' => __NAMESPACE__ . '\Objects\Logistics\AbstractLogistics',
			'seller' => __NAMESPACE__ . '\Objects\Seller\AbstractSeller',
			'system' => __NAMESPACE__ . '\Objects\System\AbstractSystem',
			'datamoat' => __NAMESPACE__ . '\Objects\Datamoat\AbstractDatamoat',
		];

		// set the application key and secret
		$this->key = $key;
		$this->secret = $secret;

		// set the venture and base URL
		$this->venture = $venture;
		$this->baseURL = $this->getEndpoint($venture);

		// throw an error if endpoint does not exist
		if (is_null($this->baseURL)) {
			throw new EndpointException('"' . $venture . '" is not a valid country ID.', 1);
		}

		// set the redirect URI
		$this->callbackURL = $callbackURL;

		// perform any overrides, where needed
		if (is_array($overrides)) {
			foreach ($overrides as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		// set the http library
		$this->http = new AbstractHttp(get_object_vars($this));
	}

	/**
	 * Sets the access token to be used throughout the API Client.
	 * 
	 * @param string $accessToken Access Token
	 */
	public function setAccessToken($accessToken) {
		$this->accessToken = $accessToken;
	}

	/**
	 * Returns the endpoint of the requested venture.
	 * 
	 * @param string $endpointKey
	 * @return string Endpoint URL
	 */
	public function getEndpoint($endpointKey) {
		// make endpointKey lowcase
		$endpointKey = strtolower($endpointKey);

		// set the endpoint URL array
		$endpoints = [
			'sg' => 'https://api.lazada.sg/rest',
			'th' => 'https://api.lazada.co.th/rest',
			'my' => 'https://api.lazada.com.my/rest',
			'vn' => 'https://api.lazada.vn/rest',
			'ph' => 'https://api.lazada.com.ph/rest',
			'id' => 'https://api.lazada.co.id/rest'
		];

		return (array_key_exists($endpointKey, $endpoints)) ? $endpoints[$endpointKey] : null;
	}
}