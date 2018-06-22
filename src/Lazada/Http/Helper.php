<?php

namespace Lazada\OpenPlatform\Http;

class Helper extends AbstractHttp {
	/**
	 * Returns the requested property in the object.
	 * 
	 * @param object $object Object
	 * @param string $properties Property Reference
	 */
	public static function getProperty($object, $properties) {
		$properties = explode('->', $properties);

		foreach ($properties as $property) {
			if (property_exists($object, $property)) {
				$object = $object->$property;
			}

			else {
				return NULL;
			}
		}

		return $object;
	}
}