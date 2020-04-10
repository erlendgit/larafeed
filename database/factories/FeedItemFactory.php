<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feed;
use App\FeedItem;
use Faker\Generator as Faker;

$factory->define(FeedItem::class, function (Faker $faker) {
    return [
        'id' => $faker->sentence,
        'published_at' => $faker->dateTime,
        'content' => ['title' => $faker->sentence],
        'feed_id' => function () {
            return factory(Feed::class)->create()->id;
        },
    ];
});

$factory->afterMaking(FeedItem::class, function ($item, Faker $faker) {
    $link = (string) $faker->url;
    $item->id = sha1($link);

    $item->content = [
        'link' => $link,
        'title' => $item->content['title'],
    ];
});
