<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
interface ConsultationVpDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ConsultationVp 
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
 	 * @param consultationVp primary key
 	 */
	public function delete($consultation_vp_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ConsultationVp consultationVp
 	 */
	public function insert($consultationVp);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ConsultationVp consultationVp
 	 */
	public function update($consultationVp);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByReasonConsultationId($value);

	public function queryByVisualProblemId($value);


	public function deleteByReasonConsultationId($value);

	public function deleteByVisualProblemId($value);


}
?>