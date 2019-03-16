<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface PrePupillaryReflexsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PrePupillaryReflexs 
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
 	 * @param prePupillaryReflex primary key
 	 */
	public function delete($pupillary_reflexs_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PrePupillaryReflexs prePupillaryReflex
 	 */
	public function insert($prePupillaryReflex);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PrePupillaryReflexs prePupillaryReflex
 	 */
	public function update($prePupillaryReflex);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPrelimaryExaminationId($value);

	public function queryByText($value);


	public function deleteByPrelimaryExaminationId($value);

	public function deleteByText($value);


}
?>