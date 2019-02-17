<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface RefractionHistoryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return RefractionHistory 
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
 	 * @param refractionHistory primary key
 	 */
	public function delete($refraction_history_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RefractionHistory refractionHistory
 	 */
	public function insert($refractionHistory);
	
	/**
 	 * Update record in table
 	 *
 	 * @param RefractionHistory refractionHistory
 	 */
	public function update($refractionHistory);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByVisitId($value);

	public function queryByDateLastExam($value);

	public function queryByCorrectionTypeId($value);

	public function queryBySatisfaction($value);

	public function queryByWearingFrequency($value);

	public function queryByReasonCorrection($value);

	public function queryByExamDetails($value);


	public function deleteByVisitId($value);

	public function deleteByDateLastExam($value);

	public function deleteByCorrectionTypeId($value);

	public function deleteBySatisfaction($value);

	public function deleteByWearingFrequency($value);

	public function deleteByReasonCorrection($value);

	public function deleteByExamDetails($value);


}
?>