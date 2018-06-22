<?php

namespace Lazada\OpenPlatform\Objects\Order;

use Lazada\OpenPlatform\Exceptions\EndpointException;

class GetOrders extends AbstractOrder {
	$getOrdersPath = '/orders/get';

	/**
	 * Get item information on one or more orders.
	 * 
	 * @param integer $offset Offset
	 * @param integer $limit Limit
	 * @param array $filters Filters
	 * @return object Response
	 */
	public function getOrders($offset = null, $limit = null, $filters = []) {
		// validate arguments and parameters passed
		if (!is_null($limit) && (is_numeric($limit) || is_integer($limit))) {
			if ((int)$limit > 100) {
				throw new EndpointException('The value for the limit parameter exceeds the limit of 100.', 2);
			}
		}

		if (array_key_exists('status', $filters) && !in_array(strtolower($filters['status']), $this->statuses)) {
			throw new EndpointException('The value for the status parameter is invalid.', 2);
		}

		if (array_key_exists('sort_direction', $filters) && !in_array(strtoupper($filters['sort_direction']), $this->sortingDirections)) {
			throw new EndpointException('The value for the sort_direction parameter is invalid.', 2);
		}

		if (array_key_exists('sort_by', $filters) && !in_array($filters['sort_by'], $this->sortingValues)) {
			throw new EndpointException('The value for the sort_by parameter is invalid.', 2);
		}

		if (!array_key_exists('created_after', $filters) && !array_key_exists('updated_after', $filters)) {
			throw new EndpointException('Either created_after or updated_after is mandatory.', 2);
		}

		// set parameters passed in filters
		$filters['limit'] = $limit;
		$filters['offset'] = $offset;

		// get multiple order items
		$response = $this->http->get($getMultipleOrderItemsPath, $filters);

		return $this->http->getProperty($response, 'data');
	}
}