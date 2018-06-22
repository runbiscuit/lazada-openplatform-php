<?php

namespace Lazada\OpenPlatform\Objects\Order;

use Lazada\OpenPlatform\Exceptions\EndpointException;

class GetDocument extends AbstractOrder {
	$getDocumentPath = '/orders/document/get';

	/**
	 * Get the document for the requested order numbers.
	 * 
	 * @param string|array|integer $orderItemIDs Order Item IDs
	 * @param string $type Document Type
	 * @return object Response
	 */
	public function getDocument($orderItemIDs, $type) {
		// check the order item IDs and set them properly
		switch (gettype($orderItemIDs)) {
			case 'integer':
				$orderItemIDs = '[' . $orderItemIDs . ']';
				break;

			case 'string':
				$orderItemIDs = '[' . $orderItemIDs . ']';
				break;

			case 'array':
				if (sizeof($orderItemIDs) > 100) {
					throw new EndpointException('The number of Order Item IDs exceeds the limit of 100.', 2)
				}

				$orderItemIDs = '[' . implode(', ', $orderItemIDs) . ']';
				break;
		}

		// get the document
		$response = $this->http->get($getDocumentPath, [
			'doc_type' => $type,
			'order_item_ids' => $orderItemIDs
		]);

		return $this->http->getProperty($response, 'data->document');
	}
}