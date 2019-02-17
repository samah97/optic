<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface VisualAntecedentDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return VisualAntecedent 
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
 	 * @param visualAntecedent primary key
 	 */
	public function delete($visual_antecedent_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisualAntecedent visualAntecedent
 	 */
	public function insert($visualAntecedent);
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisualAntecedent visualAntecedent
 	 */
	public function update($visualAntecedent);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByVisitId($value);

	public function queryByOcularPathologies($value);

	public function queryByOcularSurgeries($value);

	public function queryByTraumatism($value);

	public function queryByOrthopticTreatments($value);

	public function queryByMediciationIntakeId($value);

	public function queryByMedicationIntakeOther($value);

	public function queryByFamilialRefractive($value);

	public function queryByHerecityDiseases($value);


	public function deleteByVisitId($value);

	public function deleteByOcularPathologies($value);

	public function deleteByOcularSurgeries($value);

	public function deleteByTraumatism($value);

	public function deleteByOrthopticTreatments($value);

	public function deleteByMediciationIntakeId($value);

	public function deleteByMedicationIntakeOther($value);

	public function deleteByFamilialRefractive($value);

	public function deleteByHerecityDiseases($value);


}
?>