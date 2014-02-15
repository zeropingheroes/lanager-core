<?php namespace Zeropingheroes\LanagerCore\Helpers;

use ExpressiveDate;

class Timespan {

	public $start;
	public $end;
	public $now;

	public function __construct($start, $end)
	{
		$this->start = ExpressiveDate::make($start);
		$this->end = ExpressiveDate::make($end);

		if( $this->start->greaterThan($this->end) )
		{
			throw new \Exception('Timespan start date is after end date');
		}

		$this->now = new ExpressiveDate;
	}

	public function naturalFormat()
	{
		// if event start falls on the hour, dont display minutes
		if( $this->start->getMinute() == 0)
		{
			$startFormat = 'l ga';
		}
		else
		{
			$startFormat = 'l g:ia';
		}

		// if event start falls on the hour, dont display minutes
		if( $this->end->getMinute() == 0)
		{
			$endFormat = 'ga';
		}
		else
		{
			$endFormat = 'g:ia';
		}

		// if event does not start and end on the same day, display the end day
		if( $this->start->getDay() != $this->end->getDay() )
		{
			$endFormat = 'l '.$endFormat;
		}

		return $this->start->format($startFormat).' to '. $this->end->format($endFormat);
	}

	public function relativeStatus()
	{
		if( $this->start->greaterThan($this->now) )
		{
			return 'Starting '.$this->start->getRelativeDate();
		}

		if( $this->start->lessOrEqualTo($this->now) && $this->end->greaterOrEqualTo($this->now) )
		{
			return 'Began '.$this->start->getRelativeDate().', ending '.$this->end->getRelativeDate();
		}

		if( $this->end->lessThan($this->now) )
		{
			return 'Ended '.$this->end->getRelativeDate();
		}
	}

}