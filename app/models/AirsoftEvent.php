<?php

use Carbon\Carbon;

class AirsoftEvent extends Eloquent {
	protected $table = 'event';

	private $fb_event;

	public function getSimpleStartDate()
	{
		setlocale(LC_TIME, 'nld_nld');  
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->start);
		return $date->formatLocalized('%d %B');
		//return 'bar';
	}

	public function getDay()
	{
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->start);
		return $date->formatLocalized('%A');
	}

	public function getSimpleStart()
	{
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->start);
		return $date->formatLocalized('%A %d %B') . ", " . $date->format('H:i');
	}

	public function getSimpleEnd()
	{
		$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->end);
		return $date->formatLocalized('%A %d %B') . ", " . $date->format('H:i');
	}

	public function organisation()
	{
		return $this->belongsTo('Organisation');
	}

	public function location()
	{
		return $this->belongsTo('Location');
	}

	public function type()
	{
		return $this->belongsTo('Type');
	}

	public function ruleset()
	{
		return $this->belongsTo('RuleSet');
	}

	public function getBannerAttribute()
	{
		if(is_null($this->attributes['banner']))
		{
			return $this->location->banner;
		}
		return $this->attributes['banner'];
	}

	public function fb_event()
	{
		if(is_null($this->fb_event))
		{
			$this->fb_event = new FacebookEvent($this->fb_id);
		}
		return $this->fb_event;
	}

	public function fb_visible()
	{
		if(!is_null($this->fb_event()))
		{
			return $this->fb_event()->is_visible();
		}
		return false;
	}
}