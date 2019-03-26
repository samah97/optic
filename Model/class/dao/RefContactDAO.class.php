<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface RefContactDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return RefContact 
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
 	 * @param refContact primary key
 	 */
	public function delete($ref_eyeglasses_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RefContact refContact
 	 */
	public function insert($refContact);
	
	/**
 	 * Update record in table
 	 *
 	 * @param RefContact refContact
 	 */
	public function update($refContact);	

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

	public function queryByWearTypeId($value);

	public function queryByBrand($value);

	public function queryByDk($value);

	public function queryBySolution($value);

	public function queryByReasonIsPreferred($value);


	public function deleteByRefractionHistoryId($value);

	public function deleteBySphereOd($value);

	public function deleteBySphereOs($value);

	public function deleteByCylinderOd($value);

	public function deleteByCylinderOs($value);

	public function deleteByAxisOd($value);

	public function deleteByAxisOs($value);

	public function deleteByWearTypeId($value);

	public function deleteByBrand($value);

	public function deleteByDk($value);

	public function deleteBySolution($value);

	public function deleteByReasonIsPreferred($value);


}
?>