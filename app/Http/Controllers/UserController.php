<?php

namespace App\Http\Controllers;

use App\Love;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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

	public function setting()
	{
		$userConfig = config('user');
		$user = Auth::user();
		return view('user/setting', compact('user', 'userConfig'));
	}

	public function dosetting(Request $request)
	{
		$this->validate($request, [
			'avatar' => 'required',
			'bgimage' => 'required'
		]);

		$user = Auth::user();
		$user->avatar = Input::get('avatar');
		$user->bgimage = Input::get('bgimage');
		$user->save();
		return redirect('user/setting');
	}

	public function password()
	{
		return view('user/password');
	}

	public function dopassword(Request $request)
	{
		$this->validate($request, [
			'oldpassword' => 'required',
			'password' => 'required|confirmed|min:6'
		]);

		$user = Auth::user();

		//检查旧密码是否正确
		$oldPassword = Input::get('oldpassword');
		if (Auth::attempt(['email' => $user->email, 'password' => $oldPassword]))
		{
			// 认证通过...
			$user->password = bcrypt(Input::get('password'));
			$user->save();
			return redirect('user/password')->withErrors('更新成功！');
		}

		return redirect('user/password')->withErrors('旧密码不正确，更新失败！');

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
