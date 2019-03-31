<?php
/**
 * Class that operate on table 'patient_ambiance'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-31 19:20
 */
class PatientAmbianceMySqlDAO implements PatientAmbianceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PatientAmbianceMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM patient_ambiance WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM patient_ambiance';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM patient_ambiance ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param patientAmbiance primary key
 	 */
	public function delete($ambiance_id){
		$sql = 'DELETE FROM patient_ambiance WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ambiance_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatientAmbianceMySql patientAmbiance
 	 */
	public function insert($patientAmbiance){
		$sql = 'INSERT INTO patient_ambiance (visual_need_id) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($patientAmbiance->visualNeedId);

		$id = $this->executeInsert($sqlQuery);	
		$patientAmbiance->ambianceId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatientAmbianceMySql patientAmbiance
 	 */
	public function update($patientAmbiance){
		$sql = 'UPDATE patient_ambiance SET visual_need_id = ? WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($patientAmbiance->visualNeedId);

		$sqlQuery->setNumber($patientAmbiance->ambianceId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM patient_ambiance';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "ambiance_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM patient_ambiance WHERE ambiance_id = :ambiance_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM patient_ambiance WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $patient_ambiance)
	{
	    try {
	        $data = $this->object_to_array($patient_ambiance);
	        return $pdo->insert('patient_ambiance', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $patient_ambiance, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($patient_ambiance);
	        return $pdo->update('patient_ambiance', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('patient_ambiance', $where, $limit);
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
	
	public function object_to_array($patientAmbiance)
	{
	    $data = array(
		'ambiance_id'=>$patientAmbiance->ambianceId,
		'visual_need_id'=>$patientAmbiance->visualNeedId
	    );
	    return $data;
	}
	
	

	public function queryByvisualNeedId($value){
		$sql = 'SELECT * FROM patient_ambiance WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByvisualNeedId($value){
		$sql = 'DELETE FROM patient_ambiance WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PatientAmbianceMySql 
	 */
	protected function readRow($row){
		$patientAmbiance = new PatientAmbiance();
		
		$patientAmbiance->ambianceId = $row['ambiance_id'];
		$patientAmbiance->visualNeedId = $row['visual_need_id'];

		return $patientAmbiance;
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
	 * @return PatientAmbianceMySql 
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