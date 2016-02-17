<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    //
	protected $table = 'fm_songs';
	protected $primaryKey = 'song_id';

	protected $fillable = [
		'song_name',
		'song_authors',
		'song_path',
		'song_language',
		'song_source',
		'song_style',
		'song_moods',
		'song_image'
	];

	public $timestamps = false;

	public static function random()
	{
		$song =  self::orderBy(DB::raw('RAND()'))->first();
		return $song;
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'song_user');
	}

}
