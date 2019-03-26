<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface PreliminaryExaminationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PreliminaryExamination 
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
 	 * @param preliminaryExamination primary key
 	 */
	public function delete($preliminary_examination_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PreliminaryExamination preliminaryExamination
 	 */
	public function insert($preliminaryExamination);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PreliminaryExamination preliminaryExamination
 	 */
	public function update($preliminaryExamination);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByVisitId($value);

	public function queryByHarmonDistanceId($value);

	public function queryByConvergenceBrisDistancte($value);

	public function queryByConvergenceRecoverement($value);

	public function queryByConvergenceXy($value);

	public function queryByStereoacuityWirtTest($value);

	public function queryByOcularMotility($value);


	public function deleteByVisitId($value);

	public function deleteByHarmonDistanceId($value);

	public function deleteByConvergenceBrisDistancte($value);

	public function deleteByConvergenceRecoverement($value);

	public function deleteByConvergenceXy($value);

	public function deleteByStereoacuityWirtTest($value);

	public function deleteByOcularMotility($value);


}
?>