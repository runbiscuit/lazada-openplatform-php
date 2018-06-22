<?php

namespace Lazada\OpenPlatform\Objects\Order;

class GetFailureReasons extends AbstractOrder {
	$getFailureReasonsPath = '/orders/failure_reason/get';

	/**
	 * Get failure reasons available for SetStatusToCanceled API.
	 * 
	 * @return object Response
	 */
	public function getFailureReasons() {
		// get failure reasons
		$response = $this->http->get($getFailureReasonsPath);

		return $this->http->getProperty($response, 'data');
	}
}