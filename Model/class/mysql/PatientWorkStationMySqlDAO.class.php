<?php
/**
 * Class that operate on table 'patient_work_station'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-31 19:20
 */
class PatientWorkStationMySqlDAO implements PatientWorkStationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PatientWorkStationMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM patient_work_station WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM patient_work_station';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM patient_work_station ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param patientWorkStation primary key
 	 */
	public function delete($work_station_id){
		$sql = 'DELETE FROM patient_work_station WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($work_station_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatientWorkStationMySql patientWorkStation
 	 */
	public function insert($patientWorkStation){
		$sql = 'INSERT INTO patient_work_station (visual_need_id) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($patientWorkStation->visualNeedId);

		$id = $this->executeInsert($sqlQuery);	
		$patientWorkStation->workStationId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatientWorkStationMySql patientWorkStation
 	 */
	public function update($patientWorkStation){
		$sql = 'UPDATE patient_work_station SET visual_need_id = ? WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($patientWorkStation->visualNeedId);

		$sqlQuery->setNumber($patientWorkStation->workStationId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM patient_work_station';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "work_station_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM patient_work_station WHERE work_station_id = :work_station_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM patient_work_station WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $patient_work_station)
	{
	    try {
	        $data = $this->object_to_array($patient_work_station);
	        return $pdo->insert('patient_work_station', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $patient_work_station, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($patient_work_station);
	        return $pdo->update('patient_work_station', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('patient_work_station', $where, $limit);
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
	
	public function object_to_array($patientWorkStation)
	{
	    $data = array(
		'work_station_id'=>$patientWorkStation->workStationId,
		'visual_need_id'=>$patientWorkStation->visualNeedId
	    );
	    return $data;
	}
	
	

	public function queryByvisualNeedId($value){
		$sql = 'SELECT * FROM patient_work_station WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByvisualNeedId($value){
		$sql = 'DELETE FROM patient_work_station WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PatientWorkStationMySql 
	 */
	protected function readRow($row){
		$patientWorkStation = new PatientWorkStation();
		
		$patientWorkStation->workStationId = $row['work_station_id'];
		$patientWorkStation->visualNeedId = $row['visual_need_id'];

		return $patientWorkStation;
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
	 * @return PatientWorkStationMySql 
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