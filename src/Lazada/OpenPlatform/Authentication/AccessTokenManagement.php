<?php

namespace Lazada\OpenPlatform\Authentication;

use Lazada\OpenPlatform\Exceptions\AuthorizationException;

class AccessTokenManagement extends AbstractAuthentication {
	$authorizationPath = '/auth/token/create';
	$refreshPath = '/auth/token/refresh';

	/**
	 * Gets the access token using an Authorization Code.
	 * 
	 * @param string $code Authorization Code from OAuth Authorization
	 */
	public function getAccessToken($code) {
		// get the access token
		$response = $this->http->get($authorizationPath, [
			'code' => $code
		]);

		return $response;
	}

	/**
	 * Renews the access token.
	 * 
	 * @param string $refreshToken Refresh Token to renew Access Tokeb
	 */
	public function renewAccessToken($refreshToken) {
		// get the response
		$response = $this->http->get($refreshPath, [
			'refresh_token' => $refreshToken
		]);
	}
}