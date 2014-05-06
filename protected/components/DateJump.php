<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DateInterval
 * @created 06.05.2014 10:09:24
 * @author Mihail Kornilov <fix-06 at yandex.ru>
 */
class DateJump extends CComponent
{

	private $day;
	private $offset;
	private $defDate;
	private $separator;
	
	/**
	 *
	 * @var DateTime
	 */
	private $startDate;
	
	/**
	 *
	 * @var DateTime
	 */
	private $endDate;
	
	/**
	 *
	 * @var DateInterval
	 */
	private $interval;
	
	const DATE_FORMAT = 'Y/m/d';


	/**
	 * This finction need to generate string that contained start date that 
     * creating that nearest day $day of week from current date, and end 
     * date that formed that offset by $offset days from start date.
     * @param integer $day - number of week day (0 - 6) 0 - sunday, 1 - monday ...
     *          if day is larger that 6 or less that 0 it will stay at 0
     * @param integer $offset - shift for find date that on $offset days larger 
     *          that date how was found for $day. If $offset less that 0, then
     *          it will be stay at 7
     * @param string $defDate - by default is current date. Set date that using
     *          how base date with respect to witch calculating start date. 
     *          This parameter must be a valid parsing date format for example '01/01/2014'
     * @param string $separator - string that separate date interval
	 */
	public function __construct($day = 0, $offset = 7, $defDate = 'now', $separator = ' - ') 
	{
		$this->day    = (int) $day;
		$this->offset = (int) $offset;
		
		if ($day < 0 || $day > 6) {
            $this->day = 0;
        }
        if ($offset < 0) {
            $this->offset = 7;
        }
		
		$this->defDate   = $defDate;
		$this->separator = $separator;
		
		$this->startDate = new DateTime($this->defDate);
		
		$currDateDescription = getdate($this->startDate->getTimestamp());

        $currDayOffset = $this->day - $currDateDescription['wday'];

        $currDayOffset = ($currDayOffset <= 0) ? abs($currDayOffset) : 7 - $currDayOffset;

        $this->interval = new DateInterval('P' . $currDayOffset . 'D');

        $this->startDate->sub($this->interval);

        $this->interval->d = $this->offset;

        $this->endDate = clone $this->startDate;
        $this->endDate->add($this->interval);
	}

	
	/**
     * 
     * @return string date diff from start date to date that is offseting 
     *          from start date
     */
    public function getWeekDateInterval($dateFormat = self::DATE_FORMAT) 
	{
        return $this->startDate->format($dateFormat) . $this->separator . $this->endDate->format($dateFormat);
    }
	
	/**
	 * 
	 * @return DateTime
	 */
	public function getStartDate()
	{
		return clone $this->startDate;
	}
	
	/**
	 * 
	 * @return DateTime
	 */
	public function getEndDate()
	{
		return clone $this->endDate;
	}
	
	/**
	 * 
	 * @param string $newSep
	 */
	public function setSeparator($newSep)
	{
		$this->separator = $newSep;
	}
	
	/**
	 * Check if current date in interval of this DateJump
	 * @return boolean 
	 */
	public function isCurrent() 
	{
		$now = date(self::DATE_FORMAT);
		
		if (($this->startDate->format(self::DATE_FORMAT) <= $now) &&
			($this->endDate->format(self::DATE_FORMAT)   >= $now)) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * @return DateTime
	 */
	public function prev() 
	{
		$tmp = clone $this->startDate;
		$tmp->sub($this->interval);
		return $tmp;
	}
	
	/**
	 * @return DateTime Description
	 */
	public function next()
	{
		$tmp = clone $this->endDate;
		$tmp->add($this->interval);
		return $tmp;
	}
}
