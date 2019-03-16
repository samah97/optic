<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
interface OcularMotilityDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return OcularMotility 
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
 	 * @param ocularMotility primary key
 	 */
	public function delete($ocular_motility_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param OcularMotility ocularMotility
 	 */
	public function insert($ocularMotility);
	
	/**
 	 * Update record in table
 	 *
 	 * @param OcularMotility ocularMotility
 	 */
	public function update($ocularMotility);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByImage($value);

	public function queryByPosition($value);


	public function deleteByImage($value);

	public function deleteByPosition($value);


}
?>