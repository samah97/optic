<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-31 19:20
 */
interface PatientWorkStationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PatientWorkStation 
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
 	 * @param patientWorkStation primary key
 	 */
	public function delete($work_station_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatientWorkStation patientWorkStation
 	 */
	public function insert($patientWorkStation);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatientWorkStation patientWorkStation
 	 */
	public function update($patientWorkStation);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByvisualNeedId($value);


	public function deleteByvisualNeedId($value);


}
?>