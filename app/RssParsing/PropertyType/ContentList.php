<?php


namespace App\RssParsing\PropertyType;


class ContentList {

    public function parse($object, $key)
    {
        $result = [];
        if (property_exists($object, $key)) {
            foreach ($object->{$key} as $item) {
                try {
                    $result[] = $item->_content[0];
                }
                catch (\Exception $e) {
                }
            }
        }
        return $result;
    }

}
