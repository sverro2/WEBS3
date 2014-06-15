<?php

class DataTable{

	/*
	$table_markup = array(
		//the syntax of the array:

		'column_name' => 'Viewable text,link href,enum(search and replace)'					//after comma's no space!

		Viewable text / href syntax:
		'Plane text {database/function()} - {other/var} - {var}'							//it is possible to mix text and database values

		href:
		Same as above, but when using #! the current hostname is return (for local pages)

		Enum:
		'database_value1>replacement1|database_value1>replacement1'

		Examples:
		'Name' => '{name}'																	//just returns the name value
		'Watch' => 'Goto {organisation/name} {getDate()},#!{website}'						//returns the name of the organisation and a date. #!{url} where url is the laravel route is set as the link href
		"Event" => "Event is {is_full},,0>Available|1>Full"									//{is_full} return 0 or 1 which get replaced
	*/
	
	//create table canvas
	//$input_data = eloquent model, $markup = the markup array, $id= the table id
	static public function create_data_table($input_data, $table_markup, $id){

		$tablecontent = array();
		$tablecontent[] = "<table id='$id'  class='display' cellspacing='0' width='100%'>";

		$tablecontent[] = DataTable::create_header($table_markup, "thead");
		$tablecontent[] = DataTable::create_header($table_markup, "tfoot");

		if(sizeof($input_data) > 0){
			$tablecontent[] = DataTable::parse_content($table_markup, $input_data);
		}

		$tablecontent[] = "</table>";
		$tablecontent[] = "<script type='text/javascript'>
							$(document).ready(function(){
							$('#$id').dataTable();
							});
							</script>";

		return implode($tablecontent);

	}

	//create table header/footer
	//tag_type = thead|tfoot
	static private function create_header(&$table_markup, $tag_type){
		$header = array();
		$header[] = "<$tag_type><tr>";

		foreach (array_keys($table_markup) as $column) {
			$header[] = "<td>$column</td>";
		}

		$header[] = "</tr></$tag_type>";
		return implode($header);
	}

	static private function parse_content(&$table_markup, &$data){
		$content = array();
		$amount_of_rows = sizeof($data);
		$markup = DataTable::read_markup($table_markup);

		$content[] = "<tbody>";

		for($rownr = 0; $rownr < $amount_of_rows; $rownr++){
			$content[] = "<tr>";
			foreach ($markup as $value) {

				//get data from database
				$field_value = DataTable::get_data($data, $rownr, $value['words']);

				//replace data when required
				if(isset($value['enum'])){
					foreach ($value['enum'] as $original => $replacement) {
						foreach ($field_value as $key => $input) {
							$field_value[$key] = str_replace($original, $replacement, $input);
						}
					}
				}

				//add it to the table
				if(!in_array("", $field_value)){
					$content[] = "<td>";

					foreach ($field_value as $replace) {
						$pos = strpos($value['text'], '{}');
						$value['text'] = substr_replace($value['text'],$replace,$pos,strlen("{}"));
					}

					$content[] = $value['text'];
					$content[] = "</td>";
				}else{
					//what to do when a field does require a link, but the database does not delever one?
					$content[] = "<td> - </td>";
				}

			}
			
			$content[] = "</tr>";
		}

		$content[] = "</tbody>";
		return implode($content);
	}

	//read data from the database
	static private function get_data(&$data, $row, $replacement){
		$input = array();
		foreach ($replacement as $replace) {
			$array_path = explode("/", $replace);
			$current_row = $data[$row];

			if(sizeof($array_path) > 1){
				$replace = array_pop($array_path);
				$current_row = DataTable::get_array_sliced($array_path, $current_row);
			}

			if(strpos($replace, "()")){
				$replace = str_replace("()", "", $replace);
				$input[] = $current_row->{$replace}();
				continue;
			}

			$input[] = $current_row->$replace;
		}

		return $input;
	}

	//needed to support a tree hierarchy
	static private function get_array_sliced($indexes, $arrayToAccess)
		{
	   	if(count($indexes) > 1) 
	    	return DataTable::get_array_sliced(array_slice($indexes, 1), $arrayToAccess[$indexes[0]]);
	   	else
	   		return $arrayToAccess[$indexes[0]];
	}

	//analyse the table markup array you sent to this class
	static private function read_markup(&$table_markup){

		$markup = array();

		foreach ($table_markup as $value) {
			$this_column = array();
			$markup_base = explode(",", $value);
			DataTable::replace_hash_with_host($markup_base);
			$replace = DataTable::replacement_regex($markup_base);

			if (sizeof($markup_base) > 1 && $markup_base[1] !== ""){
				$text = "<a href='$markup_base[1]'>$markup_base[0]</a>";
			}else{
				$text = $markup_base[0];
			}

			if(isset($markup_base[2])){
				$enum = array();
				$sets = explode("|", $markup_base[2]);

				foreach ($sets as $set) {
					$values = explode("=>", $set);
					$enum[$values[0]] = $values[1];
				}
			}

			$markup[] = array('text' => $text, 'words' => $replace, 'enum' => @$enum);

		}

		return $markup;

	}

	//scan for {data} objects to replace
	static private function replacement_regex(&$input_string){
		$all_matches = array();

		foreach ($input_string as &$string) {
			preg_match_all('/{(.*?)}/', $string, $matches);
			$string = preg_replace('/{(.*?)}/', "{}", $string);
			$all_matches = array_merge($matches[1], $all_matches);
		}

		return $all_matches;

	}

	//# will be automatically translated to the host the website is running on
	static private function replace_hash_with_host(&$input_string){
		foreach ($input_string as &$string) {
			if (strpos($string, "#!") !== false){
				$string = str_replace("#!", "", $string);
				$string = URL::to($string);
			}
		}
	}

}