<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (ini_get('DEMO_PASSWORD') and ini_get('DEMO_MAIL') and ini_get('DEMO_NAME')) {
            tap(new App\User, function ($user) {
                $user->password = Hash::make(ini_get('DEMO_PASSWORD'));
                $user->email = ini_get('DEMO_NAME');
                $user->name = ini_get('DEMO_NAME');
            })->save();
        }

        App\Feed::createFromUrl("https://blog.cleancoder.com/atom.xml")->fetchItems();
        App\Feed::createFromUrl("https://simpleprogrammer.com/feed/")->fetchItems();
        App\Feed::createFromUrl("https://www.bitsoffreedom.nl/feed/")->fetchItems();
        App\Feed::createFromUrl("https://www.freelance.nl/rss/projects.xml?hash=e27e481ee758dd057e9cb86596748151b44e65ad")->fetchItems();
        App\Feed::createFromUrl("https://www.xkcd.com/rss.xml")->fetchItems();
        App\Feed::createFromUrl("http://www.israeltoday.nl/Portals/2/news.xml")->fetchItems();
        App\Feed::createFromUrl("https://logos.nl/feed/")->fetchItems();
        App\Feed::createFromUrl("https://css-tricks.com/feed/")->fetchItems();
    }

}
