<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface ControlDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Control 
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
 	 * @param control primary key
 	 */
	public function delete($control_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Control control
 	 */
	public function insert($control);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Control control
 	 */
	public function update($control);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>