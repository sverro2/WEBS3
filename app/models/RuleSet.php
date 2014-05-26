<?php

class RuleSet extends Eloquent {
	protected $table = 'ruleset';

	public function rules()
	{
		return $this->belongsToMany('Rule','ruleset_rule','ruleset_id','rule_id');
	}
}