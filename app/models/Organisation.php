<?php

class Organisation extends Eloquent {
	protected $table = 'organisation';
	public $timestamps = false;

	public function locations()
	{
		return $this->hasMany('Location');
	}

	public function events()
	{
		return $this->hasMany('AirsoftEvent');
	}

	public function ruleSets()
	{
		return $this->hasMany('Ruleset');
	}

	public function defaultRules()
	{
		return $this->hasOne('RuleSet');
	}
}