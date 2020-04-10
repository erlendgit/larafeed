<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadStatus extends Model {

    protected $fillable = ['user_id', 'feed_item_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedItem()
    {
        return $this->belongsTo(FeedItem::class);
    }

}
