<?php namespace Zeropingheroes\LanagerCore\Seeds;

use \Illuminate\Database\Seeder,
	\Eloquent;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('Zeropingheroes\LanagerCore\Seeds\RolesTableSeeder');
		$this->call('Zeropingheroes\LanagerCore\Seeds\InfoPagesTableSeeder');
		$this->call('Zeropingheroes\LanagerCore\Seeds\EventTypesTableSeeder');
		$this->call('Zeropingheroes\LanagerCore\Seeds\PlaylistsTableSeeder');
	}

}