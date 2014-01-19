<?php
namespace Zeropingheroes\LanagerCore\Repositories;


interface SteamAppRepositoryInterface {

	/**
	 * Get all Steam Applications
	 *
	 * @return object SteamApplication|null
	 */
	public function getAppList();

}