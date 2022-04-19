<?php 
/** Class Common_query 
All common database query methods
**/
/*** object name: $query_obj ***/
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
		//define('BASE_URL', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
	}

	/**Function to get clients from web_clients table
	* @return array  
	**/
	function getOurClients() {
	    return $this->db->query("SELECT * FROM web_clients where is_deleted=0  ORDER BY sequence ASC");
	}

	/**Function to get All About us information from web_about_info table
	* @return array  
	**/
	function getAboutUsInformation() {
	    return $this->db->query("SELECT * FROM web_about_info where is_deleted=0  order by sequence");
	}

	/**Function to get All products from web_products_category table
	* @return array  
	**/
	function getAllProductCategories() {
	    return $this->db->query("SELECT * FROM web_products_category where is_deleted=0 order by sequence");
	}

	/**Function to get All products sub category from web_products_sub_category table
	* @params $category_id type integer
	* @return array  
	**/
	function getProductCategoryDataByCatID($category_id=0) {
	    return $this->db->query("SELECT * FROM web_products_category where is_deleted=0 and id = ".$category_id." order by sequence");
	}

	/**Function to get All products sub category from web_products_sub_category table
	* @params $category_id type integer
	* @return array  
	**/
	function getProductSubCategoryByCategoryID($category_id=0) {
	    return $this->db->query("SELECT * FROM web_products_sub_category where is_deleted=0 and category_id = ".$category_id." order by sequence");
	}

	/**Function to get products sub category details by product_sub_cat_id from web_products_sub_category table
	* @params $sub_cat_id type integer
	* @return array  
	**/
	function getProductSubCategoryDataBySubCatID($sub_cat_id=0) {
	    return $this->db->query("SELECT * FROM web_products_sub_category where id = ".$sub_cat_id." order by sequence");
	}

	/**Function to get All products from web_products table
	* @params $category_id type integer
	* @params $sub_cat_id type integer
	* @return array  
	**/
	function getProductByCategoryID($category_id=0, $sub_cat_id=0)
	{	
		$sql = '';
		if($sub_cat_id){
			$sql = " and sub_cat_id=".$sub_cat_id;
		}
		return $this->db->query("SELECT * FROM web_products where is_deleted=0 and category_id = ".$category_id.$sql." order by sequence");
	}

	/**Function to get products from web_products table
	* @params $product_id type integer
	* @return array  
	**/
	function getProductDetailsByID($product_id=0)
	{	
		return $this->db->query("SELECT * FROM web_products where is_deleted=0 and id = ".$product_id);
	}
}

?>