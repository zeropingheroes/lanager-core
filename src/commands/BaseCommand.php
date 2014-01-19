<?php namespace Zeropingheroes\LanagerCore\Commands;

use Illuminate\Console\Command;

class BaseCommand extends Command {

	/**
	 * The timestamp format for console messages.
	 *
	 * @var string
	 */
	protected $timestampFormat = 'Y-m-d H:i:s';

	public function customInfo($message)
	{
		$this->info(date($this->timestampFormat).' - Info: '.$message);
	}

	public function customError($message)
	{
		$this->error(date($this->timestampFormat).' - Error: '.$message);
	}

}