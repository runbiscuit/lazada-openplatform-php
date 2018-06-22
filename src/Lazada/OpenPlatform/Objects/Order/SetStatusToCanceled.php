<?php

namespace Lazada\OpenPlatform\Objects\Order;

class SetStatusToCanceled extends AbstractOrder {
	$getCancellationPath = '/order/cancel';

	/**
	 * Set the status of the order to canceled.
	 * 
	 * @param integer $orderItemID Order Item ID
	 * @param integer $reasonID Reason ID
	 * @param string $reasonDetail Reason Detail
	 * @return object Response
	 */
	public function setStatusToCanceled($orderItemID, $reasonID, $reasonDetail = null) {
		// set parameters
		$parameters = [
			'order_item_id' => $orderItemID,
			'invoice_number' => $invoiceNumber
		];

		if (!is_null($reasonDetail)) {
			$parameters['reason_detail'] = $reasonDetail;
		}

		// set order status to canceled
		$response = $this->http->post($getCancellationPath, $parameters);
		$success = $this->http->getProperty($response, 'success');

		// return true or false for the situation
		return ($success == true);
	}
}