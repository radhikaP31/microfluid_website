<?php 
/** Class Common
All common database query methods
**/
/*** object name: $common ***/
Class Class_common{

	function __construct(){
		$this->db = Database::getConnection();
	}

	/*
	Function for get dynamic breadcrumbs
	* @param html_character type $separator
	* @param varchar type $home
	* @return string  
	*/
	function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
	    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
	    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

	    // This will build our "base URL" ... Also accounts for HTTPS :)
	    if(array_key_exists('HTTPS', $_SERVER)){

	    	$base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	    }else{
	    	$base = 'http' . '://' . $_SERVER['HTTP_HOST'] . '/';
	    }
	 
	    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
	    $breadcrumbs = Array("<a href=\"$base\">$home</a>");
	 
	    // Find out the index for the last value in our path array
	    $all_keys = array_keys($path);
	    $last = end($all_keys);
	 
	    // Build the rest of the breadcrumbs
	    foreach ($path AS $x => $crumb) {
	        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
	        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));
	 
	        // If we are not on the last index, then display an <a> tag
	        if ($x != $last)
	            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
	        // Otherwise, just display the title (minus)
	        else
	            $breadcrumbs[] = $title;
	    }
	 
	    // Build our temporary array (pieces of bread) into one big string :)
	    return implode($separator, $breadcrumbs);
	}

	/* function for get language
	* @params varchar type $variable_name
	* @return string
	*/
	function getLanguage($variable_name=''){

		$result = $this->db->query("SELECT name FROM web_language where variable='".$variable_name."'");

		if ($result->num_rows > 0) {
		    $value = $result->fetch_assoc();
		}

		return $value['name'];
	}

	/*function for get master data by type code
	* @params varchar type $type_code
	* @return array
	*/
	function getIndependentDataByTypeCode($type_code=''){

		$result = $this->db->query("SELECT * FROM independent_mst where type_cd='".$type_code."' order by sequence asc");
		return $result;
	}

}

?>