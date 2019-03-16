<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface PupillaryReflexsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PupillaryReflexs 
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
 	 * @param pupillaryReflex primary key
 	 */
	public function delete($pupillary_reflexs_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PupillaryReflexs pupillaryReflex
 	 */
	public function insert($pupillaryReflex);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PupillaryReflexs pupillaryReflex
 	 */
	public function update($pupillaryReflex);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>