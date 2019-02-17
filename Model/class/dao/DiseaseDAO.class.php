<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface DiseaseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Disease 
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
 	 * @param disease primary key
 	 */
	public function delete($disease_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Disease disease
 	 */
	public function insert($disease);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Disease disease
 	 */
	public function update($disease);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>