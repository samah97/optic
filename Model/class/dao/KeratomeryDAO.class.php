<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface KeratomeryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Keratomery 
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
 	 * @param keratomery primary key
 	 */
	public function delete($keratomery_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Keratomery keratomery
 	 */
	public function insert($keratomery);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Keratomery keratomery
 	 */
	public function update($keratomery);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByFirstMerOd($value);

	public function queryByFirstAxisOd($value);

	public function queryBySecondMerOd($value);

	public function queryBySecondAxisOd($value);

	public function queryByAnteriorAstigmationOd($value);

	public function queryByFirstMerOs($value);

	public function queryByFirstAxisOs($value);

	public function queryBySecondMerOs($value);

	public function queryBySecondAxisOs($value);

	public function queryByAnteriorAstigmationOs($value);

	public function queryByPreliminaryExaminationId($value);


	public function deleteByFirstMerOd($value);

	public function deleteByFirstAxisOd($value);

	public function deleteBySecondMerOd($value);

	public function deleteBySecondAxisOd($value);

	public function deleteByAnteriorAstigmationOd($value);

	public function deleteByFirstMerOs($value);

	public function deleteByFirstAxisOs($value);

	public function deleteBySecondMerOs($value);

	public function deleteBySecondAxisOs($value);

	public function deleteByAnteriorAstigmationOs($value);

	public function deleteByPreliminaryExaminationId($value);


}
?>