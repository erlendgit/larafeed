<?php

namespace App\Http\Controllers;

use App\Feed;

class FeedController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('feeds', [
            'feeds' => Feed::all(),
        ]);
    }

    public function show(Feed $feed)
    {
        return view('feed', [
            'feed' => $feed,
            'pager' => $feed->items()->paginate(20),
        ]);
    }

}
