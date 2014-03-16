<?php namespace Zeropingheroes\LanagerCore\Seeds;

use \Illuminate\Database\Seeder,
	\Illuminate\Support\Facades\DB,
	Zeropingheroes\LanagerCore\Models\Playlist;

class PlaylistsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('playlists')->delete(); // Empty before we seed

		$playlists = array(
			array('name' => 'Default'),
		);

		foreach($playlists as $playlist)
		{
			Playlist::create($playlist);
		}
	}
}
