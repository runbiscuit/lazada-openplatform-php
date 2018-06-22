<?php

namespace Lazada\OpenPlatform\Objects\Order;

use Lazada\OpenPlatform\Exceptions\EndpointException;

class SetStatusToPackedByMarketplace extends AbstractOrder {
	$setStatusToPackedByMarketplacePath = '/order/pack';

	/**
	 * Set the status of the order to being packed.
	 * 
	 * @param integer $orderItemIDs Order Item IDs
	 * @param string $deliveryType Delivery Type
	 * @param string $shippingProvider Shipping Provider
	 * @return object Response
	 */
	public function setStatusToPackedByMarketplace($orderItemIDs, $deliveryType, $shippingProvider) {
		// check the order item IDs and set them properly
		switch (gettype($orderItemIDs)) {
			case 'integer':
				$orderItemIDs = '[' . $orderItemIDs . ']';
				break;

			case 'string':
				$orderItemIDs = '[' . $orderItemIDs . ']';
				break;

			case 'array':
				$orderItemIDs = '[' . implode(', ', $orderItemIDs) . ']';
				break;
		}

		// validate arguments passed
		if ($deliveryType == 'dropship' && (is_null($shippingProvider) || empty($shippingProvider))) {
			throw new EndpointException('The shipping_provider parameter is mandatory for the "dropship" delivery type.', 2);
		}

		// set order status to being packed
		$response = $this->http->post($setStatusToPackedByMarketplacePath, [
			'order_item_ids' => $orderItemIDs,
			'delivery_type' => $deliveryType,
			'shipping_provider' => $shippingProvider
		]);

		return $this->http->getProperty($response, 'data->order_items');
	}
}