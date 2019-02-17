<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface TypeCorrectionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return TypeCorrection 
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
 	 * @param typeCorrection primary key
 	 */
	public function delete($type_correction_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TypeCorrection typeCorrection
 	 */
	public function insert($typeCorrection);
	
	/**
 	 * Update record in table
 	 *
 	 * @param TypeCorrection typeCorrection
 	 */
	public function update($typeCorrection);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>