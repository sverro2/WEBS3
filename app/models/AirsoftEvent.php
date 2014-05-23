<?php

class AirsoftEvent extends Eloquent {
	protected $table = 'event';

	public $organisation;

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

	public function getOrganisationName(){
		$organisation = Organisation::find($this->organisation_id);
		return $organisation->name;
	}

	public function getOrganisation(){
		return Organisation::find($this->organisation_id);
	}

	public function organisation(){
		return $this->belongsTo('Organisation');
	}
}