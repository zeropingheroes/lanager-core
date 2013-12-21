<?php
namespace Zeropingheroes\LanagerCore\Models;

use Illuminate\Auth\UserInterface;

class User extends BaseModel implements UserInterface
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array(); // Currently OpenID only so no passwords are stored

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	public function roles()
	{
		return $this->belongsToMany('Zeropingheroes\LanagerCore\Models\Role');
	}

	public function permissions()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\Permission');
	}

	public function hasRole($key) 
	{
		foreach($this->roles as $role)
		{
			if($role->name === $key)
			{
			return true;
			}
		}
		return false;
	}

	public function steamStates()
	{
        return $this->hasMany('Zeropingheroes\LanagerCore\Models\SteamState', 'steam_id_64', 'steam_id_64');
	}

}