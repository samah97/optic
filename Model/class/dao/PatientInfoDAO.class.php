<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface PatientInfoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PatientInfo 
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
 	 * @param patientInfo primary key
 	 */
	public function delete($patient_info_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatientInfo patientInfo
 	 */
	public function insert($patientInfo);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatientInfo patientInfo
 	 */
	public function update($patientInfo);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);

	public function queryByDob($value);

	public function queryByAddress($value);

	public function queryByPhone($value);

	public function queryByGenderId($value);

	public function queryByOccupation($value);

	public function queryByReferred($value);

	public function queryByHobbies($value);


	public function deleteByName($value);

	public function deleteByDob($value);

	public function deleteByAddress($value);

	public function deleteByPhone($value);

	public function deleteByGenderId($value);

	public function deleteByOccupation($value);

	public function deleteByReferred($value);

	public function deleteByHobbies($value);


}
?>