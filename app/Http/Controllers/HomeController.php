<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Love;
use App\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $music = Music::orderBy('music_id', 'desc')->first();

        $love = [
            'song_collection_id' => $music->music_id,
            'love_source' => 1
        ];

        $loves = Love::where($love)->count();
        $is_love = false;
        if(Auth::user())
        {
            $love['love_user'] = Auth::user()->id;
            $row = Love::where($love)->first();
            if($row) $is_love = true;
        }

        $previous = Music::where('music_id', '<', $music->music_id)->max('music_id');
        $next = Music::where('music_id', '>', $music->music_id)->min('music_id');

        return view('music/show', compact('music', 'loves', 'is_love', 'previous', 'next'));
    }
}
