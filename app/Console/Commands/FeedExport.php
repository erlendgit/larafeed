<?php

namespace App\Console\Commands;

use App\Feed;
use Illuminate\Console\Command;

class FeedExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export feeds';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Feed::filterEnabled()->get()->map(function ($feed) {
            $this->info($feed->url);
        });
    }
}
