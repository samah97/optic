<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface VaMeasurementDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return VaMeasurement 
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
 	 * @param vaMeasurement primary key
 	 */
	public function delete($va_measurement_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VaMeasurement vaMeasurement
 	 */
	public function insert($vaMeasurement);
	
	/**
 	 * Update record in table
 	 *
 	 * @param VaMeasurement vaMeasurement
 	 */
	public function update($vaMeasurement);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPreliminaryExaminationId($value);

	public function queryByUnaidedFarOd($value);

	public function queryByUnaidedFarOs($value);

	public function queryByUnaidedBinocularFar($value);

	public function queryByUnaidedBinocularNear($value);

	public function queryByAidedFarOd($value);

	public function queryByAidedFarOs($value);

	public function queryByAidedBinocularFar($value);

	public function queryByAidedBinocularNear($value);


	public function deleteByPreliminaryExaminationId($value);

	public function deleteByUnaidedFarOd($value);

	public function deleteByUnaidedFarOs($value);

	public function deleteByUnaidedBinocularFar($value);

	public function deleteByUnaidedBinocularNear($value);

	public function deleteByAidedFarOd($value);

	public function deleteByAidedFarOs($value);

	public function deleteByAidedBinocularFar($value);

	public function deleteByAidedBinocularNear($value);


}
?>