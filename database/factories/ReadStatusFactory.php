<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FeedItem;
use App\ReadStatus;
use App\User;
use Faker\Generator as Faker;

$factory->define(ReadStatus::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'feed_item_id' => function () {
            return factory(FeedItem::class)->create()->id;
        },
    ];
});
