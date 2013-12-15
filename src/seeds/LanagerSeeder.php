<?php

use Illuminate\Database\Seeder,
Zeropingheroes\LanagerCore\Models\InfoPage,
Zeropingheroes\LanagerCore\Models\Role;

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
		$this->call('RolesTableSeeder');
	}

}

class InfoPageTableSeeder extends Seeder {

    public function run()
    {

        DB::table('info_pages')->delete(); // Empty before we seed

        $lanagerContent = 
        "*What the hell is this?*\r\n\r\n"
        ."This site is the LANager, available to you during your stay and designed to make life easier for everyone!\r\n\r\n"
        ."**On the LANager you can:**\r\n\r\n"
        ."* Find out useful stuff from the [Info](/info) section\r\n\r\n"
        ."* ... more to come\r\n\r\n";


        InfoPage::create(array(
        	'title' => 'The LANager',
			'content' => $lanagerContent
			));
				
    }

}


class RolesTableSeeder extends Seeder {
    
    public function run()
    {

        DB::table('roles')->delete(); // Empty before we seed

        $roles = array(
        	array('name' => 'SuperAdmin'),
        	array('name' => 'InfoPageAdmin'),
        	);
        
        foreach($roles as $role)
        {
	        Role::create($role);
        }
	}
}

