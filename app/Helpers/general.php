<?php

if ( ! function_exists('_lang')){
	function _lang($string=''){

		//Get Target language
		$target_lang = false;
		if (session("lang")) {
			if (session("lang") == "fr") {
				$target_lang = "fr";
			}
			if (session("lang") == "en") {
				$target_lang = "en";
			}
		}

		if(empty($target_lang)){
			session(["lang" => "fr"]);
			$target_lang = "fr";
		}

		if(file_exists(resource_path() . "/language/$target_lang.php")){
			include(resource_path() . "/language/$target_lang.php");
		}else{
			include(resource_path() . "/language/en.php");
		}

		if (array_key_exists($string,$language)){
			return $language[$string];
		}else{
			return $string;
		}
	}
}


if ( ! function_exists('startsWith')){
	function startsWith($haystack, $needle)
	{
		 $length = strlen($needle);
		 return (substr($haystack, 0, $length) === $needle);
	}
}

if ( ! function_exists('currency')){
	function currency()
	{
		 return get_option('currency_symbol','$');
	}
}



if ( ! function_exists('create_option')){
	function create_option($table,$value,$display,$selected="",$where=NULL){
		$options = "";
		$condition = "";
		if($where != NULL){
			$condition .= "WHERE ";
			foreach( $where as $key => $v ){
				$condition.=$key."'".$v."' ";
			}
		}

		$query = DB::select("SELECT $value, $display FROM $table $condition");
		foreach($query as $d){
			if( $selected!="" && $selected == $d->$value ){
				$options.="<option value='".$d->$value."' selected='true'>".ucwords($d->$display)."</option>";
			}else{
				$options.="<option value='".$d->$value."'>".ucwords($d->$display)."</option>";
			}
		}

		echo $options;
	}
}

if ( ! function_exists('get_table')){
	function get_table($table,$where=NULL)
	{
		$condition = "";
		if($where != NULL){
			$condition .= "WHERE ";
			foreach( $where as $key => $v ){
				$condition.=$key."'".$v."' ";
			}
		}
		$query = DB::select("SELECT * FROM $table $condition");
		return $query;
	}
}


if ( ! function_exists('user_count')){
	function user_count($user_type)
	{
		$count = \App\User::where("user_type",$user_type)
						->selectRaw("COUNT(id) as total")
						->first()->total;
	    return $count;
	}
}


if ( ! function_exists('get_logo')){
	function get_logo()
	{
		$logo = get_option("logo");
		if($logo ==""){
			return asset("public/images/company-logo.png");
		}
		return asset("public/uploads/$logo");
	}
}

if ( ! function_exists('get_favicon')){
	function get_favicon()
	{
		$favicon = get_option("favicon");
		if($favicon ==""){
			return asset("public/images/favicon.png");
		}
		return asset("public/uploads/$favicon");
	}
}

if ( ! function_exists('sql_escape')){
	function sql_escape($unsafe_str)
	{
		if (get_magic_quotes_gpc())
		{
			$unsafe_str = stripslashes($unsafe_str);
		}
		return $escaped_str = str_replace("'", "", $unsafe_str);
	}
}

if ( ! function_exists('get_option')){
	function get_option($name, $optional="")
	{
		$setting = DB::table('settings')->where('name', $name)->get();
	    if ( ! $setting->isEmpty() ) {
		   return $setting[0]->value;
		}
		return $optional;

	}
}


if ( ! function_exists('timezone_list'))
{

 function timezone_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['ZONE'] = $zone;
    $zones_array[$key]['GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}

}

if ( ! function_exists('create_timezone_option'))
{

 function create_timezone_option($old="") {
  $option = "";
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
	$selected = $old == $zone ? "selected" : "";
	$option .= '<option value="'. $zone .'"'.$selected.'>'. 'GMT ' . date('P', $timestamp) .' '.$zone.'</option>';
  }
  echo $option;
}

}


if ( ! function_exists( 'get_country_list' ))
{
    function get_country_list( $old_data='' ) {
		if( $old_data == "" ){
			echo file_get_contents( app_path().'/Helpers/country.txt' );
		}else{
			$pattern='<option value="'.$old_data.'">';
			$replace='<option value="'.$old_data.'" selected="selected">';
			$country_list=file_get_contents( app_path().'/Helpers/country.txt' );
			$country_list=str_replace($pattern,$replace,$country_list);
			echo $country_list;
		}
    }
}

if ( ! function_exists('decimalPlace'))
{

 function decimalPlace($number){
    return number_format((float)$number, 2);
 }

}


if( !function_exists('load_language') ){
	function load_language($active=''){
		$path = resource_path() . "/language";
		$files = scandir($path);
		$options="";

		foreach($files as $file){
		    $name = pathinfo($file, PATHINFO_FILENAME);
			if($name == "." || $name == "" || $name == "language"){
				continue;
			}

			$selected = "";
			if($active == $name){
				$selected = "selected";
			}else{
				$selected = "";
			}

			$options .= "<option value='$name' $selected>".ucwords($name)."</option>";

		}
		echo $options;
	}
}

if ( ! function_exists('object_to_string')){
	function object_to_string($object, $col, $quote = false)
	{
		$string = "";
		foreach($object as $data){
			if($quote == true){
				$string .="'".$data->$col."', ";
			}else{
				$string .=$data->$col.", ";
			}
		}
		$string = substr_replace($string, "", -2);
		echo $string;
	}
}

if( !function_exists('get_language_list') ){
	function get_language_list(){
		$path = resource_path() . "/language";
		$files = scandir($path);
		$array = array();

		foreach($files as $file){
		    $name = pathinfo($file, PATHINFO_FILENAME);
			if($name == "." || $name == "" || $name == "language"){
				continue;
			}

			$array[] = $name;

		}
		return $array;
	}
}
