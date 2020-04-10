<?php

namespace App\Http\Controllers;

use App\FeedItem;

class HomeController extends Controller {

    public function index()
    {
        return view('home', [
            'pager' => FeedItem::paginate(20),
        ]);
    }

}
