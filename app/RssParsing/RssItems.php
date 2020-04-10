<?php


namespace App\RssParsing;


use App\RssParsing\PropertyType\Content;
use App\RssParsing\PropertyType\ContentList;
use App\RssParsing\PropertyType\Link;

class RssItems {

    protected $channel;

    protected $item;

    public function parse($object)
    {
        $this->channel = resolve(Channel::class)->parse($object);

        yield from $this->parseByKey('item');
        yield from $this->parseByKey('entry');
    }

    protected function parseByKey($key)
    {
        if (property_exists($this->channel, $key)) {
            foreach ($this->channel->{$key} as $object) {
                $this->item = $object;
                yield [
                    'id' => sha1($this->getId()),
                    'title' => $this->getTitle(),
                    'link' => $this->getLink(),
                    'published_at' => new \DateTime($this->getPublishedAt()),
                    'author' => $this->getAuthor(),
                    'category' => $this->getCategory(),
                    'description' => $this->getDescription(),
                ];
            }
        }
    }

    protected function getId()
    {
        foreach (['guid', 'id', 'link'] as $key) {
            if (property_exists($this->item, $key)) {
                $result = resolve(Link::class)->parse($this->item, $key);
                if ($result) {
                    return $result;
                }
            }
        }
    }

    protected function getTitle()
    {
        return resolve(Content::class)->parse($this->item, 'title');
    }

    protected function getLink()
    {
        return resolve(Link::class)->parse($this->item, 'link');
    }

    protected function getPublishedAt()
    {
        return resolve(Content::class)->parse($this->item, 'updated')
            ?? resolve(Content::class)->parse($this->item, 'pubDate');
    }

    protected function getAuthor()
    {
        return resolve(Content::class)->parse($this->item, 'dc:creator');
    }

    protected function getCategory()
    {
        return resolve(ContentList::class)->parse($this->item, 'category');
    }

    protected function getDescription()
    {
        return resolve(Content::class)->parse($this->item, 'description')
            ?? resolve(Content::class)->parse($this->item, 'content');
    }


}
