<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-04 22:53
 */
interface MedicationIntakeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return MedicationIntake 
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
 	 * @param medicationIntake primary key
 	 */
	public function delete($medication_intake_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MedicationIntake medicationIntake
 	 */
	public function insert($medicationIntake);
	
	/**
 	 * Update record in table
 	 *
 	 * @param MedicationIntake medicationIntake
 	 */
	public function update($medicationIntake);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>