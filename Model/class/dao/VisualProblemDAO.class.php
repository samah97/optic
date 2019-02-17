<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface VisualProblemDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return VisualProblem 
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
 	 * @param visualProblem primary key
 	 */
	public function delete($visual_problem_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisualProblem visualProblem
 	 */
	public function insert($visualProblem);
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisualProblem visualProblem
 	 */
	public function update($visualProblem);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTitle($value);


	public function deleteByTitle($value);


}
?>