<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface FunctionalSignDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return FunctionalSign 
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
 	 * @param functionalSign primary key
 	 */
	public function delete($functional_sign_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param FunctionalSign functionalSign
 	 */
	public function insert($functionalSign);
	
	/**
 	 * Update record in table
 	 *
 	 * @param FunctionalSign functionalSign
 	 */
	public function update($functionalSign);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>