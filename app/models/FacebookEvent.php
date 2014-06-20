<?php

class FacebookEvent  {

	private $id;
	private $facebook;
	private $visible;
	private $attending = "onbekend";
	private $maybe = "onbekend";
	private $invited = "onbekend";

	public function __construct($event_id)
	{
		$this->id = $event_id;
		$this->facebook = new Facebook(Config::get('facebook'));
		$this->visible = $this->is_visible();
		if($this->visible){
			$this->attending = $this->attending();
			$this->maybe = $this->maybe();
			$this->invited = $this->invited();
		}
	}

	public function is_visible()
	{
		try{
		$response = $this->facebook->api(
    		$this->id
		)['privacy'];
		if($response === "OPEN")
			return true;
		}catch (Exception $e)
		{
			Log::info($this->id);
			Log::info($e);
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

	private function getProperty($name)
	{
		if($this->visible)
		{
			$response = $this->facebook->api(
	    		'/' . $this->id
			)[$name];
			return $response;
		}
		return null;
	}

	private function getAllProperties()
	{
		if($this->visible)
		{
			$response = $this->facebook->api(
	    		'/' . $this->id
			);
			return $response;
		}
		return null;
	}

	public function toArray()
	{
		$visible = $this->is_visible();
		$return = array();
		$return['visible'] = $visible;
		$return['attending'] = $this->attending;
		$return['maybe'] = $this->maybe;
		$return['invited'] = $this->invited;
		if($visible)
		{
			$event = $this->getAllProperties();
			foreach($event as $key=>$property)
			{
				try{
					$return[$key] = $property;
				}catch(Exception $e){}
			}
		}

		return $return;
	}
}