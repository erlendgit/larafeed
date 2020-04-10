<?php

namespace App\Console\Commands;

use App\Feed;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class FeedCreate extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a feed from a URL';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->addArgument('url', InputArgument::REQUIRED, 'Url to the XML feed');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Feed::createFromUrl($this->argument('url'))->fetchItems();
    }

}
