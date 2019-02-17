<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:56
 */
interface UsersDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Users 
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
 	 * @param user primary key
 	 */
	public function delete($userId);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Users user
 	 */
	public function insert($user);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Users user
 	 */
	public function update($user);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByFirstname($value);

	public function queryByLastname($value);

	public function queryByUserName($value);

	public function queryByPassword($value);

	public function queryBySession($value);


	public function deleteByFirstname($value);

	public function deleteByLastname($value);

	public function deleteByUserName($value);

	public function deleteByPassword($value);

	public function deleteBySession($value);


}
?>