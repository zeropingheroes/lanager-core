<?php namespace Zeropingheroes\LanagerCore\Helpers;

use ExpressiveDate;

class Duration {

	public $duration;
	public $hoursSection;
	public $minutesSection;
	public $secondsSection;

	public function __construct($duration)
	{
		$this->duration = $duration;
		$this->hoursSection = (int) floor($this->duration / 3600);
		$this->minutesSection = (int) $this->duration / 60 % 60;
		$this->secondsSection = (int) $this->duration % 60;
	}

	public function shortFormat()
	{
		if( $this->hoursSection >= 1 )
		{
			return sprintf('%sh %sm %ss', $this->hoursSection, $this->minutesSection, $this->secondsSection);
		}
		if( $this->minutesSection >= 1 )
		{
			return sprintf('%sm %ss', $this->minutesSection, $this->secondsSection);
		}
		
		return sprintf('%ss', $this->secondsSection);
	}

	public function lcdFormat()
	{
		return sprintf('%02d:%02d:%02d', $this->hoursSection, $this->minutesSection, $this->secondsSection);
	}

	public function longFormat()
	{
		if( $this->hoursSection >= 1 )
		{
			return sprintf(
				' %s ' . str_plural('hour', $this->hoursSection) .
				' %s ' . str_plural('minute', $this->minutesSection) .
				' %s ' . str_plural('second', $this->secondsSection)
				, $this->hoursSection, $this->minutesSection, $this->secondsSection);
		}
		if( $this->minutesSection >= 1 )
		{
			return sprintf(
				' %s ' . str_plural('minute', $this->minutesSection) .
				' %s ' . str_plural('second', $this->secondsSection)
				, $this->minutesSection, $this->secondsSection);
		}
		
		return sprintf(' %s ' . str_plural('second', $this->secondsSection), $this->secondsSection);
	}

}