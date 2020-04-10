<?php


namespace App\RssParsing\PropertyType;


class Content {

    public function parse($object, $key)
    {
        try {
            if (property_exists($object, $key)) {
                return $object->{$key}[0]->_content[0];
            }
        }
        catch (\Exception $e) {
        }
    }

}
