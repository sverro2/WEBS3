<?php

class Rule extends Eloquent {
	protected $table = 'rule';

	public function ruleSet()
	{
		return $this->belongsToMany('RuleSet');
	}
}