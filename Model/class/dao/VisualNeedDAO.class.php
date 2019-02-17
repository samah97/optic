<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface VisualNeedDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return VisualNeed 
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
 	 * @param visualNeed primary key
 	 */
	public function delete($visual_need_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisualNeed visualNeed
 	 */
	public function insert($visualNeed);
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisualNeed visualNeed
 	 */
	public function update($visualNeed);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByVisitId($value);

	public function queryByIsFar($value);

	public function queryByIsNear($value);

	public function queryByIsPartially($value);

	public function queryByIsFully($value);

	public function queryByTaskDuration($value);

	public function queryByWorkDistance($value);

	public function queryByWorkStationId($value);

	public function queryByLighting($value);

	public function queryByIsNeedColor($value);

	public function queryByAmbianceId($value);

	public function queryByAmbianceOther($value);

	public function queryByIsTraumaRisk($value);

	public function queryByDescription($value);

	public function queryByExtraProffessionActivity($value);


	public function deleteByVisitId($value);

	public function deleteByIsFar($value);

	public function deleteByIsNear($value);

	public function deleteByIsPartially($value);

	public function deleteByIsFully($value);

	public function deleteByTaskDuration($value);

	public function deleteByWorkDistance($value);

	public function deleteByWorkStationId($value);

	public function deleteByLighting($value);

	public function deleteByIsNeedColor($value);

	public function deleteByAmbianceId($value);

	public function deleteByAmbianceOther($value);

	public function deleteByIsTraumaRisk($value);

	public function deleteByDescription($value);

	public function deleteByExtraProffessionActivity($value);


}
?>