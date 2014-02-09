<?php namespace Zeropingheroes\LanagerCore\Seeds;

use \Illuminate\Database\Seeder,
	\Illuminate\Support\Facades\DB;
use	Zeropingheroes\LanagerCore\Models\EventType;

class EventTypesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('event_types')->delete(); // Empty before we seed

		$eventTypes = array(
			array(
				'name'	=> 'Ceremony',
				'colour'=>	'',
			),
			array(
				'name'	=> 'Big Game',
				'colour'=>	'#19A601', // light green
			),
			array(
				'name'	=> 'Tournament',
				'colour'=>	'#19A601', // light green
			),
			array(
				'name'	=> 'Food',
				'colour'=>	'',
			),
			

		);

		foreach($eventTypes as $eventType)
		{
			EventType::create($eventType);
		}
	}
}
