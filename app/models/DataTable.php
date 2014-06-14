<?php

class DataTable{

	/*
	Example tableMarkup:
	$table_markup = array(
			'Organisatie' => '{name}',								//shows the name of the organisation as text
			'Facebook' => '{facebook},Open',						//shows a link with the text "Open" linking to the url saved in the database
			'Website' => '{website},Website',						//shows "Website", linking to the url saved in the database
			'Events' => '#organisation/index/{name},Show Events'	//concatinates a LOCAL url (# to use local urls) with the name of the organisation 
			);
	*/
	
	//create table canvas
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

				$field_value = DataTable::get_data($data, $rownr, $value['words']);

				if(!in_array("", $field_value)){
					$content[] = "<td>";
					$content[] = str_replace("{}", $field_value[0], $value['text']);
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

	static private function get_data(&$data, $row, $replacement){
		$input = array();
		foreach ($replacement as $replace) {

			if(strpos($replace, "()")){
				$replace = str_replace("()", "", $replace);
				$input[] = $data[$row]->{$replace}();
				continue;
			}

			$input[] = $data[$row]->$replace;
		}

		return $input;
	}

	static private function read_markup(&$table_markup){

		$markup = array();

		foreach ($table_markup as $key => $value) {
			$this_column = array();
			$markup_base = explode(",", $value);
			$markup_base[0] = DataTable::replace_hash_with_host($markup_base[0]);
			$replace = DataTable::replacement_regex($markup_base[0]);

			if (sizeof($markup_base) > 1){
				$text = "<a href='$markup_base[0]'>$markup_base[1]</a>";
			}else{
				$text = $markup_base[0];
			}

			$markup[] = array('text' => $text, 'words' => $replace);

		}

		return $markup;

	}

	static private function replacement_regex(&$input_string){
		preg_match_all('/{(.*)}/i', $input_string, $matches);
		$input_string = preg_replace('/{(.*)}/i', "{}", $input_string);

		return $matches[1];
	}

	static private function replace_hash_with_host($input_string){
		return str_replace("#", "http://" . $_SERVER['SERVER_NAME'] . "/", $input_string);
	}

}