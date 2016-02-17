<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    //
	protected $table = 'fm_musics';
	protected $primaryKey = 'music_id';
	protected $dates = ['music_create'];

	protected $fillable = [
		'music_name',
		'music_image',
		'music_style',
		'music_moods',
		'music_user',
		'music_text',
		'music_create'
	];

	public $timestamps = false;

	public function songs()
	{
		return $this->belongsToMany('App\Song', 'fm_song_music');
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'music_user');
	}

}
