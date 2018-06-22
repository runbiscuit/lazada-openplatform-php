<?php

namespace Lazada\OpenPlatform\Objects\Order;

class GetOrder extends AbstractOrder {
	$getOrderPath = '/order/get';

	/**
	 * Get the list of items for a single order.
	 * 
	 * @param string|array|integer Order ID
	 * @return object Response
	 */
	public function getOrder($orderID) {
		// get multiple order items
		$response = $this->http->get($getOrderPath, [
			'order_id' => $orderID
		]);

		return $this->http->getProperty($response, 'data');
	}
}