<?php

namespace App;

use App\Services\ReadStatusService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FeedItem extends Model {

    protected $fillable = ['id', 'published_at', 'content', 'feed_id'];

    protected $casts = [
        'published_at' => 'datetime',
        'content' => 'array',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('published_at', function (Builder $builder) {
            $builder->orderBy('published_at', 'desc');
        });
    }

    public static function createFromRssEntry($entry, Feed $feed)
    {
        try {
            if ($exists = static::find($entry['id'])) {
                return null;
            }
            return static::create(static::validate([
                'id' => $entry['id'],
                'published_at' => $entry['published_at'],
                'content' => $entry,
                'feed_id' => $feed->getKey(),
            ]));
        }
        catch (\Exception $e) {
            error_log($e->getMessage());
        }
        return null;
    }

    public static function validate(array $fields)
    {
        return validator($fields, [
            'id' => ['required', 'max:255'],
            'published_at' => ['required', 'date'],
            'content' => 'required',
            'feed_id' => 'required',
        ])->validate();
    }

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }

    public function testMarkRead() {
        return tap($this->isRead(), function ($status) {
            if (!$status) {
                $this->markRead();
            }
        });
    }

    protected function isRead() {
        return app(ReadStatusService::class)->isRead($this);
    }

    protected function markRead() {
        return app(ReadStatusService::class)->markRead($this);
    }

}
