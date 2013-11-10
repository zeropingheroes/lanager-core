<?php

use Illuminate\Database\Seeder,
Zeropingheroes\LanagerCore\Models\InfoPage;

class LanagerSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('InfoPageTableSeeder');
	}

}

class InfoPageTableSeeder extends Seeder {

    public function run()
    {
        // Empty before we seed
        DB::table('info_pages')->delete();

        InfoPage::create(array(
        	'title' => 'The LANager',
			'content' =>
				"### What the hell is this? ###\r\n\r\nSo, this site, the LANager, is available to you during your stay at the event.\r\n\r\nAt this stage there isn't much here, but as features are added they'll be summarised here."
        ));

    }

}