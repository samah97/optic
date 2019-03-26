<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface ReasonConsultationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ReasonConsultation 
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
 	 * @param reasonConsultation primary key
 	 */
	public function delete($reason_consultation_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ReasonConsultation reasonConsultation
 	 */
	public function insert($reasonConsultation);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ReasonConsultation reasonConsultation
 	 */
	public function update($reasonConsultation);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByVisitId($value);

	public function queryByDateAppearance($value);

	public function queryByCharactersticsAppearance($value);

	public function queryByTimeAppearance($value);

	public function queryByFrequencyTroubles($value);

	public function queryByActivityContext($value);

	public function queryByAssociatedSymptoms($value);

	public function queryByChronicity($value);

	public function queryByEvolution($value);

	public function queryByFactorsRelief($value);

	public function queryByCompensationWormType($value);


	public function deleteByVisitId($value);

	public function deleteByDateAppearance($value);

	public function deleteByCharactersticsAppearance($value);

	public function deleteByTimeAppearance($value);

	public function deleteByFrequencyTroubles($value);

	public function deleteByActivityContext($value);

	public function deleteByAssociatedSymptoms($value);

	public function deleteByChronicity($value);

	public function deleteByEvolution($value);

	public function deleteByFactorsRelief($value);

	public function deleteByCompensationWormType($value);


}
?>