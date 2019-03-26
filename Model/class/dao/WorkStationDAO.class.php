<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface WorkStationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return WorkStation 
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
 	 * @param workStation primary key
 	 */
	public function delete($work_station_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param WorkStation workStation
 	 */
	public function insert($workStation);
	
	/**
 	 * Update record in table
 	 *
 	 * @param WorkStation workStation
 	 */
	public function update($workStation);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>