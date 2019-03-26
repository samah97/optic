<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface RefEyeglassesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return RefEyeglasses 
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
 	 * @param refEyeglasse primary key
 	 */
	public function delete($ref_eyeglasses_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RefEyeglasses refEyeglasse
 	 */
	public function insert($refEyeglasse);
	
	/**
 	 * Update record in table
 	 *
 	 * @param RefEyeglasses refEyeglasse
 	 */
	public function update($refEyeglasse);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByRefractionHistoryId($value);

	public function queryBySphereOd($value);

	public function queryBySphereOs($value);

	public function queryByCylinderOd($value);

	public function queryByCylinderOs($value);

	public function queryByAxisOd($value);

	public function queryByAxisOs($value);

	public function queryByAddition($value);

	public function queryByPdOd($value);

	public function queryByPdOs($value);

	public function queryByPrismOd($value);

	public function queryByPrismOs($value);

	public function queryByBaseOd($value);

	public function queryByBaseOs($value);


	public function deleteByRefractionHistoryId($value);

	public function deleteBySphereOd($value);

	public function deleteBySphereOs($value);

	public function deleteByCylinderOd($value);

	public function deleteByCylinderOs($value);

	public function deleteByAxisOd($value);

	public function deleteByAxisOs($value);

	public function deleteByAddition($value);

	public function deleteByPdOd($value);

	public function deleteByPdOs($value);

	public function deleteByPrismOd($value);

	public function deleteByPrismOs($value);

	public function deleteByBaseOd($value);

	public function deleteByBaseOs($value);


}
?>