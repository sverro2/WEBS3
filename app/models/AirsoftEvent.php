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

	public function getOrganisationName(){
		$orga = Organisation::find($this->organisation_id);
		return $orga->name;
	}
}