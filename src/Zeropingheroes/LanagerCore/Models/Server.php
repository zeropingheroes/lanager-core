<?php
namespace Zeropingheroes\LanagerCore\Models;


class Server extends BaseModel {
	
	public function application()
	{
		return $this->belongsTo('Zeropingheroes\LanagerCore\Models\Application');
	}
	
	public function states()
	{
		return $this->hasMany('Zeropingheroes\LanagerCore\Models\State');
	}

	public function getFullAddress()
	{
		if( $this->address && $this->port)
		{
			return $this->address.':'.$this->port;
		}
		if( $this->address )
		{
			return $this->address;
		}
	}
}