<?php

namespace App;

use App\Services\RssParserService;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

    protected $fillable = ['description', 'url'];

    public function newEloquentBuilder($query)
    {
        return new FeedQueryBuilder($query);
    }

    public static function createFromUrl($url)
    {
        try {
            /** @var \App\Services\RssParserService $parser */
            $parser = resolve(RssParserService::class);
            $response = $parser->loadResource($url)->parseHeader();
            return static::create(static::validate([
                'description' => $response['title'],
                'url' => $url,
            ]));
        }
        catch (Exception $e) {
            error_log($e->getMessage());
        }
        return null;
    }


    public static function validate(array $values)
    {
        return validator($values, [
            'description' => ['required', 'max:255'],
            'url' => ['url', 'max:255'],
        ])->validate();
    }

    public function fetchItems()
    {
        /** @var \App\Services\RssParserService $parser */
        $parser = resolve(RssParserService::class);
        foreach ($parser->loadResource($this->url)->loopItems() as $entry) {
            FeedItem::createFromRssEntry($entry, $this);
        }
        return $this;
    }

    public function items()
    {
        return $this->hasMany(FeedItem::class);
    }


    public function route()
    {
        return route('feed', ['feed' => $this]);
    }


}
