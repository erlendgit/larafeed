<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        tap(new App\User, function ($user) {
            $user->password = '$2y$10$j2yMOM984KTSMFsOCUjCWOKMRkbfMtclmj9JzdoXG120fnIWSykXq';
            $user->email = 'erwitema@gmail.com';
            $user->name = 'Erlend de Perlend';
        })->save();

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
