<?php
class OrganisationUser extends Eloquent {
	protected $table = 'organisation_user';
	public $timestamps = false;

	public function user()
	{
		return $this->hasMany('User');
	}

	public function organisation()
	{
		return $this->hasMany('Organisation');
	}
}