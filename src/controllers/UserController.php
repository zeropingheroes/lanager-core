<?php namespace Zeropingheroes\LanagerCore;

use Zeropingheroes\LanagerCore\Models\User,
	Zeropingheroes\LanagerCore\Repositories\SteamUserRepositoryInterface;
use \LightOpenID;
use App, Auth, Input, Request, Redirect, View;

class UserController extends BaseController {

	protected $steamUsers;
	
	public function __construct(SteamUserRepositoryInterface $steamUsers)
	{
		$this->steamUsers = $steamUsers;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  object  SteamUser $steamUser
	 * @return Response
	 */
	public function store($steamUser)
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if( $user = User::find($id) )
		{
			$steamUser = $this->steamUsers->getUser($user->steam_id_64);		

			return View::make('lanager-core::user.show')
						->with('title',$user->username)
						->with('user',$user)
						->with('steamUser', $steamUser);
		}
		else
		{
			App::abort(404, 'Page not found');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Authenticate the user using OpenID
	 *
	 * @return Redirect
	 */
	public function openIdLogin()
	{
		if(Input::has('openid_mode'))
		{
			$openId = new LightOpenID(Request::server('HTTP_HOST'));
	
			if($openId->validate())
			{
				$steamId = str_replace('http://steamcommunity.com/openid/id/','',$openId->identity);
				
				if($this->importSteamUser($steamId))
				{
					$user = User::where('steam_id_64', '=', $steamId)->first();
					Auth::login($user);
					return Redirect::to('/');
				}
				else
				{
					App::abort(500, 'Could not import user from Steam into database.');
				}
			}
			else
			{
				App::abort(500, 'Could not validate OpenID.');
			}
		}
		else
		{
			App::abort(400, 'Bad request.');
		}
	}

	/**
	 * Log the user out
	 *
	 * @return Redirect
	 */
	public function logout()
	{
		Auth::logout();
		return Redirect::back();
	}	

	/**
	 * Import the specified Steam user
	 *
	 * @return bool
	 */
	private function importSteamUser($steamId)
	{		
		$steamUser = $this->steamUsers->getUser($steamId);		
		
		if($steamUser != NULL)
		{
			$user = User::where('steam_id_64', '=', $steamId)->first();

			// Create new user if they are not found in the database
			if($user == NULL) $user = new User;

			$user->username 	= $steamUser->username;
			$user->steam_id_64	= $steamUser->id;
			$user->avatar		= $steamUser->avatar_url;
			$user->ip 			= Request::server('REMOTE_ADDR');

			return $user->save();
		}
		else
		{
			return FALSE;
		}
	}

}