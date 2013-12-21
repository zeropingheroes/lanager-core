<?php namespace Zeropingheroes\LanagerCore\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \DateTime;
use Illuminate\Support\Facades\DB as DB;
use Zeropingheroes\LanagerCore\Models\User,
	Zeropingheroes\LanagerCore\Models\SteamState,
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

		if(count($users) == 0)
		{
			$this->error('No users in database!');
			return;
		}
		
		$this->info('Querying Steam for user states');
		$steamUsers = $this->steamUsers->getUsers($users);

		$this->info('Inserting user states into database');
		
		$successCount = 0;
		$failureCount = 0;

		foreach($steamUsers as $steamUser)
		{
			try
			{
				// Find the user to which the state belongs to
				$user = User::where('steam_id_64',$steamUser->id)->first();

				// Create a new state
				$steamState = new SteamState;
				$steamState->user_id		= $user->id;
				$steamState->username		= $steamUser->username;
				$steamState->status_code	= $steamUser->status;
				$steamState->app_id			= $steamUser->current_app_id;
				$steamState->app_name		= $steamUser->current_app_name;
				$steamState->server_ip		= $steamUser->current_server_ip;

				$steamState->save();
	
				$successCount++; // Only incremented if no exceptions above
			}
			catch(\Exception $e) // Catch any exceptions and print an error but continue
			{
				$this->error('Error inserting user state for '.$steamUser->id.' "'.$steamUser->username.'" : '. $e->getMessage());
				$failureCount++;
			}
		}
		// Provide info on results
		$this->info($successCount.' Steam user states successfully added!');
		if( $failureCount > 0 ) $this->error($failureCount.' Steam user states were not added due to errors');
	}

}