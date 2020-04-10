<?php


namespace Tests\Feature;


use App\FeedItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class FeedItemFactoryTest extends TestCase {

    use RefreshDatabase;

    public function testShouldCreateUniqueItems()
    {
        factory(FeedItem::class, 2)->create();

        FeedItem::all()->map(function ($item) {
            $this->assertEquals(40, Str::of($item->id)->length());
            $this->assertEquals($item->id, sha1($item->content['link']));
        });
    }

}
