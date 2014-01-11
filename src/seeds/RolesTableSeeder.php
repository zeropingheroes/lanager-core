<?php namespace Zeropingheroes\LanagerCore\Seeds;

use \Illuminate\Database\Seeder,
	\Illuminate\Support\Facades\DB,
	Zeropingheroes\LanagerCore\Models\Role;

class RolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->delete(); // Empty before we seed

		$roles = array(
			array('name' => 'SuperAdmin'),
			array('name' => 'InfoPageAdmin'),
			array('name' => 'ShoutAdmin'),
		);

		foreach($roles as $role)
		{
			Role::create($role);
		}
	}
}
