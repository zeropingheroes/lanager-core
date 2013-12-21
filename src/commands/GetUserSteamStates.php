<?php namespace Zeropingheroes\LanagerCore\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \DateTime;
use Illuminate\Support\Facades\DB as DB;
use Zeropingheroes\LanagerCore\Models\User,
	Zeropingheroes\LanagerCore\Models\SteamUserState,
	Zeropingheroes\LanagerCore\Repositories\SteamUserRepositoryInterface;

class GetUserSteamStates extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'steam:get-user-states';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Retrieve and store Steam user status information for all registered users.';

	/**
	 * The steam user interface.
	 *
	 * @var SteamUser
	 */
	protected $steamUsers;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(SteamUserRepositoryInterface $steamUsers)
	{
		parent::__construct();
		$this->steamUsers = $steamUsers;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$this->info('Loading all users from database');
		$users = User::all()->lists('steam_id_64');
		
		$this->info('Querying Steam for user states');
		$steamUsers = $this->steamUsers->getUsers($users);

		$this->info('Inserting user states into database');
		foreach($steamUsers as $steamUser)
		{
			$UserSteamStates[] = array(
				'steam_id_64' => $steamUser->id,
				'username' => $steamUser->username,
				'status_code' => $steamUser->status,
				'app_id' => $steamUser->current_app_id,
				'app_name' => $steamUser->current_app_name,
				'server_ip' => $steamUser->current_server_ip,
				'created_at' => new DateTime
			);
		}
		$newStates = DB::table('user_steam_states')->insert($UserSteamStates);
		$this->info(count($steamUsers).' Steam users successfully updated!');
	}

}