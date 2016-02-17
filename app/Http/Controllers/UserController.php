<?php

namespace App\Http\Controllers;

use App\Love;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
	public function home($name = '')
	{
		$user = [];
		if('' === $name)
		{
			$user = Auth::user();
		}
		else
		{
			$user = User::where(['name' => $name])->first();
		}
		if(empty($user->name)) abort(404);

		//获取喜爱的
		$love_musics = Love::loveMusic($user->id);
		return view('user/home', compact('user', 'love_musics'));
	}

	public function song($name = '')
	{
		$user = [];
		if('' === $name)
		{
			$user = Auth::user();
		}
		else
		{
			$user = User::where(['name' => $name])->first();
		}
		if(empty($user->name)) abort(404);

		//获取喜爱的
		$love_songs = Love::loveSong($user->id);
		return view('user/song', compact('user', 'love_songs'));
	}

	public function love($source, $collection_id)
	{
		if(Auth::user())
		{
			$love = [
				'song_collection_id' => $collection_id,
				'love_source' => $source,
				'love_user' => Auth::user()->id
			];
			$row = Love::where($love)->first();
			if($row)
			{
				$row->delete();
				return 1;
			}
			else
			{
				Love::create($love);
				return 2;
			}
		}
		return 0;
	}

}
