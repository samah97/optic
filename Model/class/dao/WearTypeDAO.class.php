<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface WearTypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return WearType 
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
 	 * @param wearType primary key
 	 */
	public function delete($wear_type_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param WearType wearType
 	 */
	public function insert($wearType);
	
	/**
 	 * Update record in table
 	 *
 	 * @param WearType wearType
 	 */
	public function update($wearType);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>