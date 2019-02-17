<?php
/**
 * Class that operate on table 'refraction_history'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefractionHistoryMySqlDAO implements RefractionHistoryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return RefractionHistoryMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM refraction_history WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM refraction_history';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM refraction_history ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param refractionHistory primary key
 	 */
	public function delete($refraction_history_id){
		$sql = 'DELETE FROM refraction_history WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($refraction_history_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RefractionHistoryMySql refractionHistory
 	 */
	public function insert($refractionHistory){
		$sql = 'INSERT INTO refraction_history (visit_id, date_last_exam, correction_type_id, satisfaction, wearing_frequency, reason_correction, exam_details) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($refractionHistory->visitId);
		$sqlQuery->set($refractionHistory->dateLastExam);
		$sqlQuery->setNumber($refractionHistory->correctionTypeId);
		$sqlQuery->set($refractionHistory->satisfaction);
		$sqlQuery->set($refractionHistory->wearingFrequency);
		$sqlQuery->set($refractionHistory->reasonCorrection);
		$sqlQuery->set($refractionHistory->examDetails);

		$id = $this->executeInsert($sqlQuery);	
		$refractionHistory->refractionHistoryId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param RefractionHistoryMySql refractionHistory
 	 */
	public function update($refractionHistory){
		$sql = 'UPDATE refraction_history SET visit_id = ?, date_last_exam = ?, correction_type_id = ?, satisfaction = ?, wearing_frequency = ?, reason_correction = ?, exam_details = ? WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($refractionHistory->visitId);
		$sqlQuery->set($refractionHistory->dateLastExam);
		$sqlQuery->setNumber($refractionHistory->correctionTypeId);
		$sqlQuery->set($refractionHistory->satisfaction);
		$sqlQuery->set($refractionHistory->wearingFrequency);
		$sqlQuery->set($refractionHistory->reasonCorrection);
		$sqlQuery->set($refractionHistory->examDetails);

		$sqlQuery->setNumber($refractionHistory->refractionHistoryId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM refraction_history';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "refraction_history_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM refraction_history WHERE refraction_history_id = :refraction_history_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM refraction_history WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $refraction_history)
	{
	    try {
	        $data = $this->object_to_array($refraction_history);
	        return $pdo->insert('refraction_history', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $refraction_history, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($refraction_history);
	        return $pdo->update('refraction_history', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('refraction_history', $where, $limit);
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
	
	public function object_to_array($refractionHistory)
	{
	    $data = array(
		'refraction_history_id'=>$refractionHistory->refractionHistoryId,
		'visit_id'=>$refractionHistory->visitId,
		'date_last_exam'=>$refractionHistory->dateLastExam,
		'correction_type_id'=>$refractionHistory->correctionTypeId,
		'satisfaction'=>$refractionHistory->satisfaction,
		'wearing_frequency'=>$refractionHistory->wearingFrequency,
		'reason_correction'=>$refractionHistory->reasonCorrection,
		'exam_details'=>$refractionHistory->examDetails
	    );
	    return $data;
	}
	
	

	public function queryByVisitId($value){
		$sql = 'SELECT * FROM refraction_history WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDateLastExam($value){
		$sql = 'SELECT * FROM refraction_history WHERE date_last_exam = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCorrectionTypeId($value){
		$sql = 'SELECT * FROM refraction_history WHERE correction_type_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySatisfaction($value){
		$sql = 'SELECT * FROM refraction_history WHERE satisfaction = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByWearingFrequency($value){
		$sql = 'SELECT * FROM refraction_history WHERE wearing_frequency = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByReasonCorrection($value){
		$sql = 'SELECT * FROM refraction_history WHERE reason_correction = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByExamDetails($value){
		$sql = 'SELECT * FROM refraction_history WHERE exam_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByVisitId($value){
		$sql = 'DELETE FROM refraction_history WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDateLastExam($value){
		$sql = 'DELETE FROM refraction_history WHERE date_last_exam = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCorrectionTypeId($value){
		$sql = 'DELETE FROM refraction_history WHERE correction_type_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySatisfaction($value){
		$sql = 'DELETE FROM refraction_history WHERE satisfaction = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByWearingFrequency($value){
		$sql = 'DELETE FROM refraction_history WHERE wearing_frequency = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByReasonCorrection($value){
		$sql = 'DELETE FROM refraction_history WHERE reason_correction = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByExamDetails($value){
		$sql = 'DELETE FROM refraction_history WHERE exam_details = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return RefractionHistoryMySql 
	 */
	protected function readRow($row){
		$refractionHistory = new RefractionHistory();
		
		$refractionHistory->refractionHistoryId = $row['refraction_history_id'];
		$refractionHistory->visitId = $row['visit_id'];
		$refractionHistory->dateLastExam = $row['date_last_exam'];
		$refractionHistory->correctionTypeId = $row['correction_type_id'];
		$refractionHistory->satisfaction = $row['satisfaction'];
		$refractionHistory->wearingFrequency = $row['wearing_frequency'];
		$refractionHistory->reasonCorrection = $row['reason_correction'];
		$refractionHistory->examDetails = $row['exam_details'];

		return $refractionHistory;
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
	 * @return RefractionHistoryMySql 
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