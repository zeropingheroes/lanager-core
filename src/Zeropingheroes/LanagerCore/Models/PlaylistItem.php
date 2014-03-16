<?php
namespace Zeropingheroes\LanagerCore\Models;

class PlaylistItem extends BaseModel
{
	public static $rules = array(
		'url'			=> 'required|url|playlist_compatible_url',
		'playlist_id'	=> 'numeric|exists:playlists,id'
	);

	public function beforeSave()
	{
		// Get title and duration data from YouTube
		parse_str( parse_url( $this->url, PHP_URL_QUERY ), $youtube_url );

		// Retrieve video metadata
		$response = file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$youtube_url['v'].'?format=5&alt=json');
		$response = json_decode($response, true); // convert JSON response to array

		$this->title = $response['entry']['title']['$t'];
		$this->duration = $response['entry']['media$group']['yt$duration']['seconds'];
	}

	public function playlist()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\Playlist');
	}

	public function user()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\User');
	}
}