<?php
/**
 * Class that operate on table 'consultation_vp'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ConsultationVpMySqlDAO implements ConsultationVpDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ConsultationVpMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM consultation_vp WHERE consultation_vp_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM consultation_vp';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM consultation_vp ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param consultationVp primary key
 	 */
	public function delete($consultation_vp_id){
		$sql = 'DELETE FROM consultation_vp WHERE consultation_vp_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($consultation_vp_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ConsultationVpMySql consultationVp
 	 */
	public function insert($consultationVp){
		$sql = 'INSERT INTO consultation_vp (reason_consultation_id, visual_problem_id) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($consultationVp->reasonConsultationId);
		$sqlQuery->setNumber($consultationVp->visualProblemId);

		$id = $this->executeInsert($sqlQuery);	
		$consultationVp->consultationVpId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ConsultationVpMySql consultationVp
 	 */
	public function update($consultationVp){
		$sql = 'UPDATE consultation_vp SET reason_consultation_id = ?, visual_problem_id = ? WHERE consultation_vp_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($consultationVp->reasonConsultationId);
		$sqlQuery->setNumber($consultationVp->visualProblemId);

		$sqlQuery->setNumber($consultationVp->consultationVpId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM consultation_vp';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "consultation_vp_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM consultation_vp WHERE consultation_vp_id = :consultation_vp_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM consultation_vp WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $consultation_vp)
	{
	    try {
	        $data = $this->object_to_array($consultation_vp);
	        return $pdo->insert('consultation_vp', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $consultation_vp, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($consultation_vp);
	        return $pdo->update('consultation_vp', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('consultation_vp', $where, $limit);
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
	
	public function object_to_array($consultationVp)
	{
	    $data = array(
		'consultation_vp_id'=>$consultationVp->consultationVpId,
		'reason_consultation_id'=>$consultationVp->reasonConsultationId,
		'visual_problem_id'=>$consultationVp->visualProblemId
	    );
	    return $data;
	}
	
	

	public function queryByReasonConsultationId($value){
		$sql = 'SELECT * FROM consultation_vp WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByVisualProblemId($value){
		$sql = 'SELECT * FROM consultation_vp WHERE visual_problem_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByReasonConsultationId($value){
		$sql = 'DELETE FROM consultation_vp WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByVisualProblemId($value){
		$sql = 'DELETE FROM consultation_vp WHERE visual_problem_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ConsultationVpMySql 
	 */
	protected function readRow($row){
		$consultationVp = new ConsultationVp();
		
		$consultationVp->consultationVpId = $row['consultation_vp_id'];
		$consultationVp->reasonConsultationId = $row['reason_consultation_id'];
		$consultationVp->visualProblemId = $row['visual_problem_id'];

		return $consultationVp;
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
	 * @return ConsultationVpMySql 
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