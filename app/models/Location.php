<?php

class Location extends Eloquent {
	protected $table = 'location';
	
	public function organisation(){
		return $this->belongsTo('Organisation');
	}

	public function ruleSet()
	{
		return $this->belongsTo('RuleSet');
	}	

	public function event()
	{
		return $this->hasMany('AirsoftEvent');
	}
}