<?php


namespace App\RssParsing\PropertyType;


class Link {

    public function parse($object, $key)
    {
        try {
            if (property_exists($object, $key)) {
                $property = $object->{$key}[0];
                return $property->_attributes['href'] ?? $property->_content[0];
            }
        }
        catch (\Exception $e) {
        }
    }

}
