<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface PreCoverTestDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PreCoverTest 
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
 	 * @param preCoverTest primary key
 	 */
	public function delete($cover_test_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PreCoverTest preCoverTest
 	 */
	public function insert($preCoverTest);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PreCoverTest preCoverTest
 	 */
	public function update($preCoverTest);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPreliminaryExaminationId($value);


	public function deleteByPreliminaryExaminationId($value);


}
?>