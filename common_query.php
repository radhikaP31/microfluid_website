<?php 
/** Class Common_query 
All common database query methods
**/
session_start();
Class Common_query{

	function __construct(){
		//Add database class for connection and create mysql object
		include 'database.php';
		$this->db = Database::getConnection();

		//run constant function

		$this->constantVariables();
	}

	/**Function for declare constant**/
	function constantVariables(){

		define("BASE_URL", "http://" . $_SERVER['SERVER_NAME'].'/microfluid_website');
	}

	/**Function to get clients from web_clients table
	* @return array  
	**/
	function getOurClients() {
	    return $this->db->query("SELECT * FROM web_clients ORDER BY sequence ASC");
	}

	/**Function to add Product in Product table
	* Upload image to images folder
	* @param array type $data
	* @return boolean  
	**/

}

?>