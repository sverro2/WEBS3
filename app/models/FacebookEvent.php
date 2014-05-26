<?php

class FacebookEvent  {

	private $id;
	private $facebook;

	public function __construct($event_id)
	{
		$this->id = $event_id;
		$this->facebook = new Facebook(Config::get('facebook'));
	}

	public function is_visible()
	{
		try{
		$response = $this->facebook->api(
    		'/' . $this->id
		)['privacy'];
		if($response === "OPEN")
			return true;
		}catch (Exception $e)
		{
			return false;
		}
		return false;
	}

	public function attending()
	{
		$response = $this->facebook->api(
    		$this->id . "/attending"
		);
		return count($response['data']);
	}

	public function maybe()
	{
		$response = $this->facebook->api(
    		$this->id . "/maybe"
		);
		return count($response['data']);
	}

	public function invited()
	{
		$response = $this->facebook->api(
    		$this->id . "/invited"
		);
		return count($response['data']);
	}
}