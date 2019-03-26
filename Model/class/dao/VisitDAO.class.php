<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-23 16:00
 */
interface VisitDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Visit 
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
 	 * @param visit primary key
 	 */
	public function delete($visit_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Visit visit
 	 */
	public function insert($visit);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Visit visit
 	 */
	public function update($visit);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDatetime($value);

	public function queryByPatientInfoId($value);

	public function queryByIsFirstVisit($value);

	public function queryByDeduction($value);


	public function deleteByDatetime($value);

	public function deleteByPatientInfoId($value);

	public function deleteByIsFirstVisit($value);

	public function deleteByDeduction($value);


}
?>