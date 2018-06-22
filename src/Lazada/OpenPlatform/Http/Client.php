<?php

namespace Lazada\OpenPlatform\Http;

class Client {
	/**
	 * Make the HTTP request as requested.
	 * 
	 * @param $path string URL Path
	 * @param $parameters array Array of Parameters to be sent to the server.
	 * @return mixed
	 */
	public static function call($path, $parameters = []) {
		// initialize the curl client
		$client = curl_init();

		// preparing the parameters for request
		$parameters['app_key'] = $this->key;
		$parameters['access_token'] = $this->accessToken;
		$parameters['timestamp'] = (new DateTime())->format(DateTime::ISO8601);
		$parameters['sign_method'] = 'sha256';

		// signing - sort the parameters
		ksort($parameters);

		// signing - get signature
		$concatenatedString = $path;

		foreach ($parameters as $key => $value) {
			$concatenatedString = $concatenatedString . $key . $value;
		}

		$parameters['sign'] = hash_hmac('sha256', $concatenatedString, $this->secret, false);

	    // set options for curl client
	    curl_setopt($client, CURLOPT_URL, $this->baseURL . $path . '?' . http_build_query($parameters));
	    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($client, CURLOPT_FAILONERROR, false);
	    curl_setopt($client, CURLOPT_HEADER, false);
	    curl_setopt($client, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($client, CURLOPT_USERAGENT, 'lazada-openplatform-php');
		curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($client, CURLOPT_SSL_VERIFYHOST, false);

		// perform the curl request
		$result = curl_exec($client);

		// check for curl request status
		$error = curl_error($client);

		if (!empty($error)) {
			// an error has occurred
			$statusCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
			curl_close($client);
		}

		else {
			curl_close($client);
			return $output;
		}
	}
}