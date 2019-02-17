<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface AntecedentDiseaseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return AntecedentDisease 
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
 	 * @param antecedentDisease primary key
 	 */
	public function delete($antecedent_disease_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AntecedentDisease antecedentDisease
 	 */
	public function insert($antecedentDisease);
	
	/**
 	 * Update record in table
 	 *
 	 * @param AntecedentDisease antecedentDisease
 	 */
	public function update($antecedentDisease);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDiseaseId($value);

	public function queryByVisualAntecedentId($value);


	public function deleteByDiseaseId($value);

	public function deleteByVisualAntecedentId($value);


}
?>