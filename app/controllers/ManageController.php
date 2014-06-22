<?php

class ManageController extends BaseController {

	public function __construct() {
		parent::__construct();

		//$this->beforeFilter('auth.manages');
		//$this->beforeFilter('csrf', array('only' => 'postCreateEvent'));
	}

	public function getOrganisation($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('organisation.manage', $data);
	}

	public function getCreateEvent($organisation_url)
	{
		$data['organisation'] = Organisation::where('url', '=', $organisation_url)->firstOrFail();
		return View::make('organisation.event.create', $data);
	}

	public function getCreateLocation($organisation_url, $location_id = null){
		$data['location'] = Location::where('id', '=', $location_id)->first();
		$data['location_id'] = $location_id;
		$data['organisation_url'] = $organisation_url;
		return View::make('organisation.location', $data);
	}

	public function postSaveLocation($organisation_url){
		$input = Input::all();

		$organisation_id = Organisation::where('url', '=', $organisation_url)->firstOrFail()->id;
		$name_exists = Location::where('name', '=', $input['name'])->where('organisation_id', '=', $organisation_id)->first();
		$url_exists = Location::where('url', '=', $input['url'])->where('organisation_id', '=', $organisation_id)->first();
		$location_exists = Location::where('id', '=', $input['location_id'])->where('organisation_id', '=', $organisation_id)->first();

		//var_dump(isset($name_exists));
		//var_dump(isset($url_exists));
		//var_dump(isset($location_exists));
		//var_dump($organisation_id);


		if($location_exists){
			$location = Location::find($input['location_id']);

			$location->name = $input['name'];
			$location->url = $input['url'];
			$location->address = $input['adress'];
			$location->coordinates = $input['lat'] . ',' . $input['lng'];

			$location->save();
		}elseif(!$name_exists && !$url_exists){
			$location = new Location();

			$location->name = $input['name'];
			$location->url = $input['url'];
			$location->address = $input['adress'];
			$location->coordinates = $input['lat'] . ',' . $input['lng'];
			$location->organisation_id = $organisation_id;

			$location->save();
		}else{
			$location_id = $input['location_id'];
			return Redirect::to("manage/create-location/$organisation_url/$location_id");
		}
		
		return Redirect::to("manage/organisation/$organisation_url");
	}

	public function postRemoveLocation($organisation_url){
		$remove_location = Input::get('location');

		if(AirsoftEvent::where('location_id', '=', $remove_location)->first()){
			return "not removed";
		}

		$location = Location::find($remove_location);
		if($location->delete()){
			return "done";
		}

		return "error";
	}

	public function postRemoveEvent($organisation_url){
		$remove_event = Input::get('event_id');

		$location = AirsoftEvent::find($remove_event);
		if($location->delete()){
			return "done";
		}

		return "error";
	}

	public function getEditEvent($organisation_url, $event_id){
		$event = AirsoftEvent::where('id', '=', $event_id)->firstOrFail();
		$data['event'] = $event;
		$data['organisation'] = $event->organisation;
		return View::make('organisation.event.update', $data);
	}

	public function postEditEvent($organisation_url, $event_id)
	{
		$event = AirsoftEvent::find($event_id);

		$event->name = Input::get('event-name');
		$event->start = Input::get('event-start');
		$event->end = Input::get('event-end');
		$event->organisation_id = Input::get('organisation-id');
		$event->location_id = Input::get('event-location');
		$event->description = Input::get('event-description');
		$event->fb_id = Input::get('fb-event-id');
		$event->max_participants = Input::get('event-participants');
		$full = (Input::get('event-full') === 'on' ? '1' : '0');
		$event->is_full = $full;
		Log::info(Input::get('event-full', false));
		
		$ruleset = RuleSet::findOrFail($event->ruleset->id);
		$ruleset->rules = Input::get('event-rules');
		$ruleset->save();
		
		$event->save();
		return Redirect::back();
	}

	public function postCreateEvent($organisation_url)
	{

		$location_id = Input::get('event-location');
		$organisation_id = Input::get('organisation-id');
		$name = Input::get('event-name');
		$event = new AirsoftEvent();
		$event->name = $name;
		$event->start = Input::get('event-start');
		$event->end = Input::get('event-end');
		$event->organisation_id = $organisation_id;
		$event->location_id = $location_id;
		$event->description = Input::get('event-description');
		$event->type_id = 4;
		$event->fb_id = Input::get('fb-event-id');
		$event->max_participants = Input::get('event-participants');

		$rules = new RuleSet();
		$rules->name = $event->name . $event->start;
		$rules->rules = Input::get('event-rules');
		$rules->organisation_id = $organisation_id;
		$rules->save();

		$event->ruleset_id = $rules->id;

		$event->save();

		return Redirect::to('/');
	}

	public function postUpdateOrganisationInfo($organisation_url){
		$id = Input::get('id');
		$orgname = Input::get('orgname_edit');
		$facebook = Input::get('facebook_edit');
		$url = Input::get('url_edit');
		$ruleset = Input::get('ruleset_edit');
		$website = Input::get('website_edit');

		$table = Organisation::where('id', '=', $id)->firstOrFail();
		$ruleset = RuleSet::where('name', '=', $ruleset)->first();

		$table->name = $orgname;
		$table->facebook = $facebook;
		$table->url = $url;
		$table->ruleset_id = $ruleset->id;
		$table->website = $website;

		$table->save();
		return "succes";
	}
}
