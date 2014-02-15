<?php namespace Zeropingheroes\LanagerCore\Helpers;

use ExpressiveDate;

class Timespan {

	public $start;
	public $end;
	public $now;
	public $status;

	public function __construct($start, $end)
	{
		$this->start = ExpressiveDate::make($start);
		$this->end = ExpressiveDate::make($end);

		if( $this->start->greaterThan($this->end) )
		{
			throw new \Exception('Timespan start date is after end date');
		}

		$this->now = new ExpressiveDate;

		if( $this->start->greaterThan($this->now) )
		{
			$this->status = 0;
		}

		if( $this->start->lessOrEqualTo($this->now) && $this->end->greaterOrEqualTo($this->now) )
		{
			$this->status = 1;
		}

		if( $this->end->lessThan($this->now) )
		{
			$this->status = 2;
		}
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

}