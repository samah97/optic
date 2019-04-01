<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-31 19:20
 */
interface PatientAmbianceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PatientAmbiance 
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
 	 * @param patientAmbiance primary key
 	 */
	public function delete($ambiance_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatientAmbiance patientAmbiance
 	 */
	public function insert($patientAmbiance);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatientAmbiance patientAmbiance
 	 */
	public function update($patientAmbiance);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByvisualNeedId($value);


	public function deleteByvisualNeedId($value);


}
?>