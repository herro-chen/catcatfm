<?php

namespace App\Http\Controllers\Admin;

use App\Music;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MusicController extends BaseController
{
    //

	public function index()
	{
		$musics = Music::orderBy('music_id', 'desc')->paginate(15);
		return view('admin.music.home', compact('musics'));
	}

	public function create()
	{
		$songConfig = config('song');
		return view('admin.music.create', compact('songConfig'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'music_image' => 'required',
			'music_name' => 'required',
			'music_moods' => 'required',
			'music_text' => 'required',
			'song' => 'required'
		]);

		$music = [
			'music_image' => Input::get('music_image'),
			'music_name' => Input::get('music_name'),
			'music_moods' => Input::get('music_moods'),
			'music_text' => Input::get('music_text'),
			'music_user' => Auth::user()->id
		];

		$music = Music::create($music);

		//加入关联
		$song_ids = explode('|', Input::get('song'));
		$song_music = [];
		foreach($song_ids as $k => $v)
		{
			$song_music[] = [
				'song_id' => $v,
				'music_id' => $music->music_id
			];
		}
		DB::table('fm_song_music')->insert($song_music);

		return redirect('admin/music');
	}

	public function destroy($id)
	{
		$music = Music::find($id);
		$music->delete();
		return redirect('admin/music');
	}

}
