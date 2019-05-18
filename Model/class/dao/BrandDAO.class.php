<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-05-13 21:08
 */
interface BrandDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Brand 
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
 	 * @param brand primary key
 	 */
	public function delete($brand_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Brand brand
 	 */
	public function insert($brand);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Brand brand
 	 */
	public function update($brand);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByName($value);


	public function deleteByName($value);


}
?>