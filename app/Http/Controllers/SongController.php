<?php

namespace App\Http\Controllers;

use App\Love;
use App\Song;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SongController extends Controller
{
    //
	public function index()
	{
		$songConfig = config('song');

		$argWhere = $argGet = [];

		$keyword = Input::get('keyword');
		if($keyword)
		{
			$argGet['keyword'] = $keyword;
			$songs = Song::where('song_name', 'like', "%{$keyword}%")->orderBy('song_id', 'desc')->paginate(15);
		}
		else
		{
			$language = Input::get('language');
			if($language)
			{
				$argWhere['song_language'] = $argGet['language'] = $language;
			}
			$mood = Input::get('mood');
			if($mood)
			{
				$argWhere['song_moods'] = $argGet['mood'] = $mood;
			}
			$style = Input::get('style');
			if($style)
			{
				$argWhere['song_style'] = $argGet['style'] = $style;
			}
			$songs = Song::where($argWhere)->orderBy('song_id', 'desc')->paginate(15);
		}

		return view('song/home', compact('songs', 'songConfig', 'argGet'));
	}

	public function show($id)
	{
		$song = Song::findOrFail($id);

		$is_love = false;
		if(Auth::user())
		{
			$love = [
				'song_collection_id' => $song->song_id,
				'love_source' => 0,
				'love_user' => Auth::user()->id
			];
			$row = Love::where($love)->first();
			if($row) $is_love = true;
		}

		return view('song/show', compact('song', 'is_love'));
	}

	public function path($id)
	{
		$song = Song::findOrFail($id);
		$data = [
			"song" => $song->song_id,
			"name" => $song->song_name,
			"path" => $song->song_path,
			"author" => $song->song_authors,
			"is_love" => false,
			"image" => $song->song_image
		];
		return response()->json($data);
	}

	public function fm()
	{
		return view('song/fm');
	}

	public function random()
	{
		//
		$song = Song::random();
		$data = [
			"song" => $song->song_id,
			"name" => $song->song_name,
			"path" => $song->song_path,
			"author" => $song->song_authors,
			"is_love" => false,
			"image" => $song->song_image
		];
		return response()->json($data);
	}
}
