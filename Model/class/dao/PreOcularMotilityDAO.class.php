<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface PreOcularMotilityDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PreOcularMotility 
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
 	 * @param preOcularMotility primary key
 	 */
	public function delete($ocular_motility_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PreOcularMotility preOcularMotility
 	 */
	public function insert($preOcularMotility);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PreOcularMotility preOcularMotility
 	 */
	public function update($preOcularMotility);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPreliminaryExaminationId($value);


	public function deleteByPreliminaryExaminationId($value);


}
?>