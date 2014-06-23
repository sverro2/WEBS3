<?php

class AdminController extends BaseController {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('auth.admin');
	}

	public function getIndex()
	{
		return View::make('admin.home');
	}

	public function getBootstrap(){
		return View::make('admin.bootstrap');
	}

	public function getOrganisation(){
		$input = Organisation::all();
		$table_content = array(
			'Organisatie' => '{name}',
			'Facebook' => 'toon,{facebook}',
			'Website' => 'link,{website}',
			'Event' => '<span class="glyphicon glyphicon-search"></span>,#!organisation/index/{url}',
			'Bewerk' => '<span class="glyphicon glyphicon-wrench"></span>,#!manage/organisation/{url}',
			'Gebruikers' => '<a href="#" class="editOrganisationUsers" data-org-id="{id}" data-org-name="{name}"><span class="glyphicon glyphicon-user"></span></a>'
			);

		$data['title'] = "Organisation";
		$data['users'] = User::all();
		$data['data_table'] = DataTable::create_data_table($input, $table_content, "organisation_table");

		return View::make('admin.organisation', $data);
	}

	public function postCreateOrganisation(){
		$input = Input::all();
		$validator = Validator::make(
			array(
					'name' => $input['org_name'],
					'url' => $input['org_url'])
			,array(
					'name' => 'unique:organisation',
					'url' => 'unique:organisation')
			);

		if($validator->passes()){
			$new_organisation = new Organisation();
			$new_organisation->name = $input['org_name'];
			$new_organisation->url = $input['org_url'];
			$new_organisation->save();
			$new_id = $new_organisation->id;

			$new_ruleset = new RuleSet();
			$new_ruleset->name = 'Standaard';
			$new_ruleset->organisation_id = $new_id;
			$new_ruleset->save();
			$ruleset_id = $new_ruleset->id;

			$new_organisation->ruleset_id = $ruleset_id;
			$new_organisation->save();
		}
		return Redirect::to('admin/organisation');
	}

	public function postApplyAccount(){
		$input = Input::all();
		$user_id = User::where('username', '=', $input['user'])->first()->id;
		if(strlen($input['user']) < 1){
			return "Geen user aangegeven!";
		}
		$logins = OrganisationUser::where('user_id', '=', $user_id);
		$logins->delete();

		$new_login = new OrganisationUser();
		$new_login->organisation_id = $input['organisation'];
		$new_login->user_id = $user_id;
		$new_login->save();

		return $input['user'] . $user_id . $input['organisation'];
	}

	public function getOrganisationUser($organisation_id){
		$organisation_user = OrganisationUser::where('organisation_id', '=', $organisation_id)->get();
		$table_content = array(
			"Event" => "{user/username}"
			);
		return DataTable::create_data_table($organisation_user, $table_content, "user_table");
	}

	public function getEvent(){
		$input = AirsoftEvent::All();
		$table_content = array(
			"Event" => "{name}",
			"Start" => "{getSimpleStartDate()}",
			"Organisatie" => "{organisation/name}",
			"Vol?" => "{is_full},,0=>Plaatsen Vrij|1=>Vol",
			"Toon" => "Toon Evenement,#!/#displaymap={id}",
			"Bewerk" => "bewerk,#!manage/edit-event/{organisation/url}/{id}",
			"Remove" => "<a href='#' class='removeEvent' data-eventid='{id}' data-org-url='" . URL::to('manage/remove-event') .
				"/{organisation/url}'><span class='glyphicon glyphicon-remove'></span></a>"
			);

		$data['title'] = "Events";
		$data['data_table'] = DataTable::create_data_table($input, $table_content, "event_table");

		return View::make('admin.events', $data);
	}

	public function getSetting(){
		$data['ytURL'] = Settings::find('ytURL');
		$data['title'] = "Website Settings";

		return View::make('admin.settings', $data);
	}

	public function postSetSettings(){
		$input = Input::get('linkvalue');

		$url = Settings::find('ytURL');
		$url->value = $input;

		$url->save();

	}

}
