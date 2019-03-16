<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface HarmonDistanceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return HarmonDistance 
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
 	 * @param harmonDistance primary key
 	 */
	public function delete($harmon_distance);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param HarmonDistance harmonDistance
 	 */
	public function insert($harmonDistance);
	
	/**
 	 * Update record in table
 	 *
 	 * @param HarmonDistance harmonDistance
 	 */
	public function update($harmonDistance);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>