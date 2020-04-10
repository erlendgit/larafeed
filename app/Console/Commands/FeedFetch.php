<?php

namespace App\Console\Commands;

use App\Feed;
use Illuminate\Console\Command;

class FeedFetch extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Look for new items in all enabled feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Feed::filterEnabled()->get() as $feed) {
            /** @var $feed \App\Feed */
            $feed->fetchItems();
            info("Fetched items for {$feed->description}");
        }
    }

}
