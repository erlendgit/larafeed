<?php


namespace App\Services;


use App\RssParsing\RssHeader;
use App\RssParsing\RssItems;
use DOMDocument;
use GuzzleHttp\Client;

class RssParserService {

    protected $objectFromElements;

    public function loadResource($path)
    {
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadXML($this->readStream($path), LIBXML_NOCDATA);
        $this->objectFromElements = $this->elementToObject($doc->documentElement);
        return $this;
    }

    public function readStream($streamId) {
        $client = new Client([
            'headers' => [
                'User-Agent' => 'PostmanRuntime/v7.24.1',
                'Accept' => '*/*',
                'Accept-Encoding' => 'gzip, deflate, br',
            ],
        ]);
        $response = $client->get($streamId);
        return $response->getBody()->getContents();
    }

    public function parseHeader()
    {
        return app(RssHeader::class)->parse($this->objectFromElements);
    }

    public function loopItems()
    {
        yield from app(RssItems::class)->parse($this->objectFromElements);
    }

    protected function elementToObject($element)
    {
        $obj = (object) [
            '_attributes' => [],
            '_content' => [],
        ];
        foreach ($element->attributes as $attribute) {
            $obj->_attributes[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            switch ($subElement->nodeType) {
                case XML_COMMENT_NODE:
                    break;

                case XML_CDATA_SECTION_NODE:
                case XML_TEXT_NODE:
                    if ($text = trim($subElement->wholeText)) {
                        $obj->_content[] = trim($text);
                    }
                    break;

                default:
                    $obj->{$subElement->tagName}[] = $this->elementToObject($subElement);
            }
        }
        return $obj;
    }

}
