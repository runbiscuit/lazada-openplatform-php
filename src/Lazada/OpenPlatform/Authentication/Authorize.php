<?php

namespace Lazada\OpenPlatform\Authentication;

use Lazada\OpenPlatform\Exceptions\AuthorizationException;

class Authorize extends AbstractAuthentication {
	$authorizationPath = '/oauth/authorize';

	/**
	 * Generates the authorization URL.
	 * 
	 * @param string|null $state The status of the application; the same for input and response.
	 * @param string|null $uuid An identity assigned to the seller, which can protect the returned authorization code.
	 * @param string|array|null $country Restrict Application to Country Code
	 */
	public function authorize($state = null, $uuid = null, $country = null) {
		// check whether callbackURL is not null and is a valid URL
		if (is_null($this->callbackURL)) throw new AuthorizationException('Callback URL cannot be null!', 1);
		if (gettype($this->callbackURL) != 'string' || parse_url($this->callbackURL) == false) throw new AuthorizationException('Callback URL is misformed or of the wrong datatype!', 1);

		// set the authorization URL
		$authorizationURL = $this->authenticationBaseURL . $authorizationPath;

		// set the URL params
		$params = [
			'response_type' => 'code',
			'force_auth' => 'true',
			'redirect_uri' => $this->callbackURL,
			'client_id' => $this->key
		];

		// add other params to the authorization URL
		if (!is_null($state)) $params['state'] = $state;
		if (!is_null($uuid)) $params['uuid'] = $uuid;

		if (!is_null($country)) {
			if (gettype($country) == 'array') {
				$params['country'] = implode(',', $country);
			}

			else if (gettype($country) == 'string') {
				$params['country'] = $country;
			}
		}

		// return the set authorization URL
		$authorizationURL = $authorizationURL . '?' . http_build_query($params);
		return $authorizationURL;
	}
}