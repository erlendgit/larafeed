<?php


namespace Tests\Feature;


use App\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedQueryTest extends TestCase {

    use RefreshDatabase;

    public function testCustomQueryIntegratesInModel()
    {
        factory(Feed::class)->create(['enabled' => 0]);
        factory(Feed::class)->create(['enabled' => 1]);
        factory(Feed::class)->create(['enabled' => 1]);

        $this->assertEquals(3, Feed::count());
        $this->assertEquals(2, Feed::filterEnabled()->count());
    }

}
