<?php

namespace Lazada\OpenPlatform\Objects\Order;

use Lazada\OpenPlatform\Exceptions\EndpointException;

class GetMultipleOrderItems extends AbstractOrder {
	$getMultipleOrderItemsPath = '/orders/failure_reason/get';

	/**
	 * Get item information on one or more orders.
	 * 
	 * @param string|array|integer $orderIDs Order IDs
	 * @return object Response
	 */
	public function getMultipleOrderItems($orderIDs) {
		// check the order item IDs and set them properly
		switch (gettype($orderIDs)) {
			case 'integer':
				$orderIDs = '[' . $orderIDs . ']';
				break;

			case 'string':
				$orderIDs = '[' . $orderIDs . ']';
				break;

			case 'array':
				if (sizeof($orderItemIDs) > 1000) {
					throw new EndpointException('The number of Order Item IDs exceeds the limit of 1000.', 2)
				}

				$orderIDs = '[' . implode(', ', $orderIDs) . ']';
				break;
		}

		// get multiple order items
		$response = $this->http->get($getMultipleOrderItemsPath, [
			'order_ids' => $orderIDs
		]);

		return $this->http->getProperty($response, 'data');
	}
}