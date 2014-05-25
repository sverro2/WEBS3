<?php

class AirsoftEvent extends Eloquent {
	protected $table = 'event';

	public function getSimpleStartDate(){
		setlocale(LC_TIME, 'nld_nld');  
		$date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->start);
		return $date->formatLocalized('%d %B');
		//return 'bar';
	}

	public function getDay(){
		$date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->start);
		return $date->formatLocalized('%A');
	}

	public function organisation(){
		return $this->belongsTo('Organisation');
	}

	public function location(){
		return $this->belongsTo('Location');
	}

	public function getBannerAttribute(){
		if(is_null($this->attributes['banner']))
		{
			return $this->location->banner;
		}
		return $this->attributes['banner'];
	}
}