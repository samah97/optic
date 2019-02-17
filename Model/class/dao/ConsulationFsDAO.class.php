<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface ConsulationFsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ConsulationFs 
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
 	 * @param consulationF primary key
 	 */
	public function delete($consulation_fs_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ConsulationFs consulationF
 	 */
	public function insert($consulationF);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ConsulationFs consulationF
 	 */
	public function update($consulationF);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByReasonConsultationId($value);

	public function queryByFunctionSignId($value);


	public function deleteByReasonConsultationId($value);

	public function deleteByFunctionSignId($value);


}
?>