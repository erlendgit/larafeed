<?php


namespace App\RssParsing;


class Channel {

    public function parse($object)
    {
        try {
            if (property_exists($object, 'channel')) {
                return $object->channel[0];
            }
            return $object;
        }
        catch (\Exception $e) {
        }
    }

}
