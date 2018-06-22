<?php

namespace Lazada\OpenPlatform\Objects\Order;

use Lazada\OpenPlatform\Exceptions\EndpointException;

class SetStatusToReadyToShip extends AbstractOrder {
	$setStatusToReadyToShipPath = '/order/rts';

	/**
	 * Set the status of the order to being packed.
	 * 
	 * @param integer $orderItemIDs Order Item IDs
	 * @param string $deliveryType Delivery Type
	 * @param string $shippingProvider Shipping Provider
	 * @param string $trackingNumber Tracking Number
	 * @return object Response
	 */
	public function setStatusToReadyToShip($orderItemIDs, $deliveryType, $shippingProvider, $trackingNumber) {
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
		if ($deliveryType != 'dropship') {
			throw new EndpointException('Only the "dropship" delivery type is currently supported.', 2);
		}

		if (is_null($shippingProvider) || empty($shippingProvider)) throw new EndpointException('The shipping_provider parameter is mandatory.', 2);
		if (is_null($trackingNumber) || empty($trackingNumber)) throw new EndpointException('The tracking_number parameter is mandatory.', 2);

		// set order status to being packed
		$response = $this->http->post($setStatusToReadyToShipPath, [
			'order_item_ids' => $orderItemIDs,
			'delivery_type' => $deliveryType,
			'shipping_provider' => $shippingProvider,
			'tracking_number' => $trackingNumber
		]);

		return $this->http->getProperty($response, 'data->order_items');
	}
}