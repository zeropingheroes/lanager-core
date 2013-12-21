<?php namespace Zeropingheroes\LanagerCore\Seeds;

use \Illuminate\Database\Seeder,
	\Illuminate\Support\Facades\DB,
	Zeropingheroes\LanagerCore\Models\InfoPage;

class InfoPageTableSeeder extends Seeder {

	public function run()
	{
		DB::table('info_pages')->delete(); // Empty before we seed

		$infoPages = array(
			array(
				'title' => 'The LANager',
				'content' =>  
					"*What the hell is this?*\r\n\r\n"
					."This site is the LANager, available to you during your stay and designed to make life easier for everyone!\r\n\r\n"
					."**On the LANager you can:**\r\n\r\n"
					."* Find out useful stuff from the [Info](/info) section\r\n\r\n"
					."* ... more to come\r\n\r\n"
				)
		);
		foreach($infoPages as $infoPage)
		{
			InfoPage::create($infoPage);
		}
	}
}