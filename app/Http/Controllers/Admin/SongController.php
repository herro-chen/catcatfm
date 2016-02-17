<?php

namespace App\Http\Controllers\Admin;

use App\Song;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SongController extends Controller
{
    //
	public function index()
	{
		$songs = Song::orderBy('song_id', 'desc')->paginate(15);
		return view('admin.song.home', compact('songs'));
	}

	public function create()
	{
		return view('admin.song.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'song_id' => 'required|integer',
		]);

		$song_id = Input::get('song_id');

		//获取网易音乐
		$url = "http://music.163.com/api/song/detail/?id={$song_id}&ids=%5B{$song_id}%5D";
		$response = file_get_contents($url);
		$response = json_decode(file_get_contents($url), true);
		if($response['songs'])
		{
			$mp3_url = str_replace("http://m", "http://p", $response["songs"][0]["mp3Url"]);
			//查询是否存在
			$row = Song::where('song_path', $mp3_url)->first();
			if(empty($row))
			{
				$artists = [];
				foreach ($response["songs"][0]["artists"] as $artist)
				{
					$artists[] = $artist["name"];
				}
				$artists = implode(",", $artists);
				$song = [
					"song_name" => $response["songs"][0]["name"],
					"song_path" => $mp3_url,
					"song_authors" => $artists,
					"song_image" => $response["songs"][0]["album"]["picUrl"],
					"song_source" => 2,
					"song_language" => 1,
					"song_style" => 1,
					"song_moods" => 1
				];
				Song::create($song);
			}
		}
		return redirect('admin/song');
	}

	public function edit($id)
	{
		$song = Song::findOrFail($id);
		$songConfig = config('song');

		return view('admin.song.edit', compact('song', 'songConfig'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'song_name' => 'required',
			'song_path' => 'required',
			'song_authors' => 'required',
			'song_image' => 'required',
			'song_language' => 'required|integer',
			'song_style' => 'required|integer',
			'song_moods' => 'required|integer'
		]);

		$song = Song::findOrFail($id);

		$song->song_name = Input::get('song_name');
		$song->song_path = Input::get('song_path');
		$song->song_authors = Input::get('song_authors');
		$song->song_image = Input::get('song_image');
		$song->song_language = Input::get('song_language');
		$song->song_style = Input::get('song_style');
		$song->song_moods = Input::get('song_moods');
		if ( $song->save() )
		{
			return redirect('admin/song');
		}
		else
		{
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
	}

	public function destroy($id)
	{
		$song = Song::find($id);
		$song->delete();
		return redirect('admin/song');
	}

	public function search(Request $request)
	{
		$this->validate($request, [
			'str' => 'required',
		]);
		$keyword = Input::get('str');
		$songs = Song::where('song_name', 'like', "%{$keyword}%")->orderBy('song_id', 'desc')->limit(15)->get();
		return $songs;
	}

	public function album($id)
	{
		$url = "http://music.163.com/api/album/{$id}";

		$refer = "http://music.163.com/";
		$header[] = "Cookie: appver=2.0.2;";
		$response = json_decode(http_get($url, $header, $refer), true);

		if( $response["code"] == 200 && $response["album"] )
		{
			//处理音乐信息
			$result = $response["album"]["songs"];
			$album_author = $response["album"]["artist"]["name"];

			$album = [];
			foreach($result as $k => $value)
			{
				$mp3_url = str_replace("http://m", "http://p", $value["mp3Url"]);
				$song = [
					"song_name" => $value["name"],
					"song_path" => $mp3_url,
					"song_authors" => $album_author,
					"song_image" => $response["album"]["picUrl"],
					"song_source" => 2,
					"song_language" => 1,
					"song_style" => 1,
					"song_moods" => 1
				];
				$row = Song::where('song_path', $mp3_url)->first();
				if(empty($row))
				{
					$row = Song::create($song);
				}
				$album[] = $row;
			}
			return $album;
		}
	}

	public function playlist($id)
	{
		$url = "http://music.163.com/api/playlist/detail?id={$id}";
		$refer = "http://music.163.com/";
		$header[] = "Cookie: appver=2.0.2;";
		$response = json_decode(http_get($url), true);

		if( $response["code"] == 200 && $response["result"] )
		{
			//处理音乐信息
			$result = $response["result"]["tracks"];
			$collect = [];
			foreach($result as $k => $value)
			{
				$mp3_url = str_replace("http://m", "http://p", $value["mp3Url"]);
				$song_cover = '';
				$artists = [];
				foreach ($value["artists"] as $artist)
				{
					$artists[] = $artist["name"];
				}
				if($value['album']['picUrl']) $song_cover = $value['album']['picUrl'];

				$artists = implode(",", $artists);

				$song = [
					"song_name" => $value["name"],
					"song_path" => $mp3_url,
					"song_authors" => $artists,
					"song_image" => $song_cover,
					"song_source" => 2,
					"song_language" => 1,
					"song_style" => 1,
					"song_moods" => 1
				];
				$row = Song::where('song_path', $mp3_url)->first();
				if(empty($row))
				{
					$row = Song::create($song);
				}
				$collect[] = $row;
			}
			return $collect;
		}
	}
}
