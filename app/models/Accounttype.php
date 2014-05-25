<?php

class AccountType extends Eloquent {
	protected $table = 'account_type';

	public function users()
	{
		return $this->hasMany('User');
	}
}