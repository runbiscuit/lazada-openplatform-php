<?php

namespace Lazada\OpenPlatform\Objects\Order;

class GetOrderItems extends AbstractOrder {
	$getOrderItemsPath = '/order/items/get';

	/**
	 * Get the list of items for a single order.
	 * 
	 * @param string|array|integer Order ID
	 * @return object Response
	 */
	public function getOrderItems($orderID) {
		// get multiple order items
		$response = $this->http->get($getOrderItemsPath, [
			'order_id' => $orderID
		]);

		return $this->http->getProperty($response, 'data');
	}
}