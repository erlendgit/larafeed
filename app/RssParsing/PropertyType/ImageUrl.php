<?php


namespace App\RssParsing\PropertyType;


class ImageUrl {

    public function parse($object, $key)
    {
        try {
            if (property_exists($object, $key)) {
                return resolve(Content::class)->parse($object->{$key}[0], 'url');
            }
        }
        catch (\Exception $e) {
        }
    }

}
