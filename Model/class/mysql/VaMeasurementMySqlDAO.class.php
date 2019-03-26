<?php
/**
 * Class that operate on table 'va_measurement'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class VaMeasurementMySqlDAO implements VaMeasurementDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return VaMeasurementMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM va_measurement WHERE va_measurement_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM va_measurement';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM va_measurement ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param vaMeasurement primary key
 	 */
	public function delete($va_measurement_id){
		$sql = 'DELETE FROM va_measurement WHERE va_measurement_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($va_measurement_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VaMeasurementMySql vaMeasurement
 	 */
	public function insert($vaMeasurement){
		$sql = 'INSERT INTO va_measurement (preliminary_examination_id, unaided_far_od, unaided_far_os, unaided_binocular_far, unaided_binocular_near, aided_far_od, aided_far_os, aided_binocular_far, aided_binocular_near) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($vaMeasurement->preliminaryExaminationId);
		$sqlQuery->set($vaMeasurement->unaidedFarOd);
		$sqlQuery->set($vaMeasurement->unaidedFarOs);
		$sqlQuery->set($vaMeasurement->unaidedBinocularFar);
		$sqlQuery->set($vaMeasurement->unaidedBinocularNear);
		$sqlQuery->set($vaMeasurement->aidedFarOd);
		$sqlQuery->set($vaMeasurement->aidedFarOs);
		$sqlQuery->set($vaMeasurement->aidedBinocularFar);
		$sqlQuery->set($vaMeasurement->aidedBinocularNear);

		$id = $this->executeInsert($sqlQuery);	
		$vaMeasurement->vaMeasurementId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param VaMeasurementMySql vaMeasurement
 	 */
	public function update($vaMeasurement){
		$sql = 'UPDATE va_measurement SET preliminary_examination_id = ?, unaided_far_od = ?, unaided_far_os = ?, unaided_binocular_far = ?, unaided_binocular_near = ?, aided_far_od = ?, aided_far_os = ?, aided_binocular_far = ?, aided_binocular_near = ? WHERE va_measurement_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($vaMeasurement->preliminaryExaminationId);
		$sqlQuery->set($vaMeasurement->unaidedFarOd);
		$sqlQuery->set($vaMeasurement->unaidedFarOs);
		$sqlQuery->set($vaMeasurement->unaidedBinocularFar);
		$sqlQuery->set($vaMeasurement->unaidedBinocularNear);
		$sqlQuery->set($vaMeasurement->aidedFarOd);
		$sqlQuery->set($vaMeasurement->aidedFarOs);
		$sqlQuery->set($vaMeasurement->aidedBinocularFar);
		$sqlQuery->set($vaMeasurement->aidedBinocularNear);

		$sqlQuery->setNumber($vaMeasurement->vaMeasurementId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM va_measurement';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "va_measurement_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM va_measurement WHERE va_measurement_id = :va_measurement_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM va_measurement WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $va_measurement)
	{
	    try {
	        $data = $this->object_to_array($va_measurement);
	        return $pdo->insert('va_measurement', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $va_measurement, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($va_measurement);
	        return $pdo->update('va_measurement', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('va_measurement', $where, $limit);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function getListObj($array)
	{
	    $ret = array();
	    for ($i = 0; $i < count($array); $i ++) {
	        $ret[$i] = $this->readRow($array[$i]);
	    }
	    return $ret;
	}
	
	public function object_to_array($vaMeasurement)
	{
	    $data = array(
		'va_measurement_id'=>$vaMeasurement->vaMeasurementId,
		'preliminary_examination_id'=>$vaMeasurement->preliminaryExaminationId,
		'unaided_far_od'=>$vaMeasurement->unaidedFarOd,
		'unaided_far_os'=>$vaMeasurement->unaidedFarOs,
		'unaided_binocular_far'=>$vaMeasurement->unaidedBinocularFar,
		'unaided_binocular_near'=>$vaMeasurement->unaidedBinocularNear,
		'aided_far_od'=>$vaMeasurement->aidedFarOd,
		'aided_far_os'=>$vaMeasurement->aidedFarOs,
		'aided_binocular_far'=>$vaMeasurement->aidedBinocularFar,
		'aided_binocular_near'=>$vaMeasurement->aidedBinocularNear
	    );
	    return $data;
	}
	
	

	public function queryByPreliminaryExaminationId($value){
		$sql = 'SELECT * FROM va_measurement WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUnaidedFarOd($value){
		$sql = 'SELECT * FROM va_measurement WHERE unaided_far_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUnaidedFarOs($value){
		$sql = 'SELECT * FROM va_measurement WHERE unaided_far_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUnaidedBinocularFar($value){
		$sql = 'SELECT * FROM va_measurement WHERE unaided_binocular_far = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByUnaidedBinocularNear($value){
		$sql = 'SELECT * FROM va_measurement WHERE unaided_binocular_near = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAidedFarOd($value){
		$sql = 'SELECT * FROM va_measurement WHERE aided_far_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAidedFarOs($value){
		$sql = 'SELECT * FROM va_measurement WHERE aided_far_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAidedBinocularFar($value){
		$sql = 'SELECT * FROM va_measurement WHERE aided_binocular_far = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAidedBinocularNear($value){
		$sql = 'SELECT * FROM va_measurement WHERE aided_binocular_near = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPreliminaryExaminationId($value){
		$sql = 'DELETE FROM va_measurement WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUnaidedFarOd($value){
		$sql = 'DELETE FROM va_measurement WHERE unaided_far_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUnaidedFarOs($value){
		$sql = 'DELETE FROM va_measurement WHERE unaided_far_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUnaidedBinocularFar($value){
		$sql = 'DELETE FROM va_measurement WHERE unaided_binocular_far = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByUnaidedBinocularNear($value){
		$sql = 'DELETE FROM va_measurement WHERE unaided_binocular_near = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAidedFarOd($value){
		$sql = 'DELETE FROM va_measurement WHERE aided_far_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAidedFarOs($value){
		$sql = 'DELETE FROM va_measurement WHERE aided_far_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAidedBinocularFar($value){
		$sql = 'DELETE FROM va_measurement WHERE aided_binocular_far = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAidedBinocularNear($value){
		$sql = 'DELETE FROM va_measurement WHERE aided_binocular_near = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return VaMeasurementMySql 
	 */
	protected function readRow($row){
		$vaMeasurement = new VaMeasurement();
		
		$vaMeasurement->vaMeasurementId = $row['va_measurement_id'];
		$vaMeasurement->preliminaryExaminationId = $row['preliminary_examination_id'];
		$vaMeasurement->unaidedFarOd = $row['unaided_far_od'];
		$vaMeasurement->unaidedFarOs = $row['unaided_far_os'];
		$vaMeasurement->unaidedBinocularFar = $row['unaided_binocular_far'];
		$vaMeasurement->unaidedBinocularNear = $row['unaided_binocular_near'];
		$vaMeasurement->aidedFarOd = $row['aided_far_od'];
		$vaMeasurement->aidedFarOs = $row['aided_far_os'];
		$vaMeasurement->aidedBinocularFar = $row['aided_binocular_far'];
		$vaMeasurement->aidedBinocularNear = $row['aided_binocular_near'];

		return $vaMeasurement;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return VaMeasurementMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>