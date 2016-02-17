<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Love extends Model
{
    //
	protected $table = 'fm_loves';
	protected $primaryKey = 'love_id';

	protected $fillable = ['song_collection_id', 'love_source', 'love_user'];

	public $timestamps = false;

	public static function loveMusic($userid = 0)
	{
		return DB::table('fm_loves')
			->leftJoin('fm_musics', 'fm_loves.song_collection_id', '=', 'fm_musics.music_id')
			->where('fm_loves.love_source', 1)
			->where('fm_loves.love_user', $userid)
			->paginate(15);
	}

	public static function loveSong($userid = 0)
	{
		return DB::table('fm_loves')
			->leftJoin('fm_songs', 'fm_loves.song_collection_id', '=', 'fm_songs.song_id')
			->where('fm_loves.love_source', 0)
			->where('fm_loves.love_user', $userid)
			->paginate(15);
	}

}
