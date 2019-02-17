<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface AmbianceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Ambiance 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param ambiance primary key
 	 */
	public function delete($ambiance_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Ambiance ambiance
 	 */
	public function insert($ambiance);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Ambiance ambiance
 	 */
	public function update($ambiance);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>