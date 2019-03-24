<?php
/**
 * Class that operate on table 'visit'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-23 16:00
 */
class VisitMySqlDAO implements VisitDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return VisitMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM visit WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM visit';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM visit ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param visit primary key
 	 */
	public function delete($visit_id){
		$sql = 'DELETE FROM visit WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($visit_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisitMySql visit
 	 */
	public function insert($visit){
		$sql = 'INSERT INTO visit (datetime, patient_info_id, is_first_visit, deduction) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($visit->datetime);
		$sqlQuery->setNumber($visit->patientInfoId);
		$sqlQuery->setNumber($visit->isFirstVisit);
		$sqlQuery->set($visit->deduction);

		$id = $this->executeInsert($sqlQuery);	
		$visit->visitId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisitMySql visit
 	 */
	public function update($visit){
		$sql = 'UPDATE visit SET datetime = ?, patient_info_id = ?, is_first_visit = ?, deduction = ? WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($visit->datetime);
		$sqlQuery->setNumber($visit->patientInfoId);
		$sqlQuery->setNumber($visit->isFirstVisit);
		$sqlQuery->set($visit->deduction);

		$sqlQuery->setNumber($visit->visitId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM visit';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "visit_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM visit WHERE visit_id = :visit_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM visit WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $visit)
	{
	    try {
	        $data = $this->object_to_array($visit);
	        return $pdo->insert('visit', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $visit, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($visit);
	        return $pdo->update('visit', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('visit', $where, $limit);
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
	
	public function object_to_array($visit)
	{
	    $data = array(
		'visit_id'=>$visit->visitId,
		'datetime'=>$visit->datetime,
		'patient_info_id'=>$visit->patientInfoId,
		'is_first_visit'=>$visit->isFirstVisit,
		'deduction'=>$visit->deduction
	    );
	    return $data;
	}
	
	

	public function queryByDatetime($value){
		$sql = 'SELECT * FROM visit WHERE datetime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPatientInfoId($value){
		$sql = 'SELECT * FROM visit WHERE patient_info_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsFirstVisit($value){
		$sql = 'SELECT * FROM visit WHERE is_first_visit = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDeduction($value){
		$sql = 'SELECT * FROM visit WHERE deduction = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDatetime($value){
		$sql = 'DELETE FROM visit WHERE datetime = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPatientInfoId($value){
		$sql = 'DELETE FROM visit WHERE patient_info_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsFirstVisit($value){
		$sql = 'DELETE FROM visit WHERE is_first_visit = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDeduction($value){
		$sql = 'DELETE FROM visit WHERE deduction = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return VisitMySql 
	 */
	protected function readRow($row){
		$visit = new Visit();
		
		$visit->visitId = $row['visit_id'];
		$visit->datetime = $row['datetime'];
		$visit->patientInfoId = $row['patient_info_id'];
		$visit->isFirstVisit = $row['is_first_visit'];
		$visit->deduction = $row['deduction'];
		
		$visit->count = $row['count'];

		return $visit;
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
	 * @return VisitMySql 
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