<?php


namespace App\RssParsing;


use App\RssParsing\PropertyType\Content;
use App\RssParsing\PropertyType\ImageUrl;
use App\RssParsing\PropertyType\Link;

class RssHeader {

    protected $channel;

    public function parse($object)
    {
        $this->channel = resolve(Channel::class)->parse($object);

        return [
            'title' => $this->getTitle(),
            'link' => $this->getLink(),
            'description' => $this->getDescription(),
            'updated_at' => $this->getUpdatedAt(),
            'language' => $this->getLanguage(),
            'generator' => $this->getGenerator(),
            'site' => $this->getSite(),
            'image' => $this->getImageUrl(),
        ];
    }

    protected function getTitle()
    {
        return resolve(Content::class)->parse($this->channel, 'title');
    }

    protected function getLink()
    {
        return resolve(Link::class)->parse($this->channel, 'link');
    }

    protected function getDescription()
    {
        return resolve(Content::class)->parse($this->channel, 'description');
    }

    protected function getUpdatedAt()
    {
        return resolve(Content::class)->parse($this->channel, 'lastBuildDate')
            ?? resolve(Content::class)->parse($this->channel, 'updated');
    }

    protected function getLanguage()
    {
        return resolve(Content::class)->parse($this->channel, 'language');
    }

    protected function getGenerator()
    {
        return resolve(Content::class)->parse($this->channel, 'generator');
    }

    protected function getSite()
    {
        return resolve(Link::class)->parse($this->channel, 'site');
    }

    protected function getImageUrl() {
        return resolve(ImageUrl::class)->parse($this->channel, 'image');
    }

}
