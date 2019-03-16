<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface CoverTestDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return CoverTest 
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
 	 * @param coverTest primary key
 	 */
	public function delete($cover_test_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CoverTest coverTest
 	 */
	public function insert($coverTest);
	
	/**
 	 * Update record in table
 	 *
 	 * @param CoverTest coverTest
 	 */
	public function update($coverTest);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>