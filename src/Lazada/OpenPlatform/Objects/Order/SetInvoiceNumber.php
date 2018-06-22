<?php

namespace Lazada\OpenPlatform\Objects\Order;

class SetInvoiceNumber extends AbstractOrder {
	$setInvoiceNumberPath = '/orders/invoice_number/set';

	/**
	 * Set the order invoice number.
	 * 
	 * @param string|integer $orderItemID Order Item ID
	 * @param string $invoiceNumber Invoice Number
	 * @return object Response
	 */
	public function setInvoiceNumber($orderItemID, $invoiceNumber) {
		// set invoice number
		$response = $this->http->post($setInvoiceNumberPath, [
			'order_item_id' => $orderItemID,
			'invoice_number' => $invoiceNumber
		]);

		return $this->http->getProperty($response, 'data');
	}
}