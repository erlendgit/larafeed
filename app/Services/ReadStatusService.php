<?php


namespace App\Services;


use App\FeedItem;
use App\ReadStatus;
use Illuminate\Http\Request;

class ReadStatusService {

    protected $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function isRead(FeedItem $feedItem)
    {
        if ($this->user) {
            /** @var \App\ReadStatus $status */
            return ReadStatus::cursor()
                ->where('user_id', $this->user->id)
                ->where('feed_item_id', $feedItem->id)
                ->first();
        }
    }

    public function markRead(FeedItem $feedItem)
    {
        if ($this->user) {
            ReadStatus::create([
                'user_id' => $this->user->id,
                'feed_item_id' => $feedItem->id,
            ]);
        }

    }

}
