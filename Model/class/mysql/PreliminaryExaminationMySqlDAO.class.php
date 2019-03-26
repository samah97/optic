<?php
/**
 * Class that operate on table 'preliminary_examination'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PreliminaryExaminationMySqlDAO implements PreliminaryExaminationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PreliminaryExaminationMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM preliminary_examination WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM preliminary_examination';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM preliminary_examination ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param preliminaryExamination primary key
 	 */
	public function delete($preliminary_examination_id){
		$sql = 'DELETE FROM preliminary_examination WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($preliminary_examination_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PreliminaryExaminationMySql preliminaryExamination
 	 */
	public function insert($preliminaryExamination){
		$sql = 'INSERT INTO preliminary_examination (visit_id, harmon_distance_id, convergence_bris_distancte, convergence_recoverement, convergence_xy, stereoacuity_wirt_test, ocular_motility) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($preliminaryExamination->visitId);
		$sqlQuery->setNumber($preliminaryExamination->harmonDistanceId);
		$sqlQuery->set($preliminaryExamination->convergenceBrisDistancte);
		$sqlQuery->set($preliminaryExamination->convergenceRecoverement);
		$sqlQuery->set($preliminaryExamination->convergenceXy);
		$sqlQuery->set($preliminaryExamination->stereoacuityWirtTest);
		$sqlQuery->setNumber($preliminaryExamination->ocularMotility);

		$id = $this->executeInsert($sqlQuery);	
		$preliminaryExamination->preliminaryExaminationId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PreliminaryExaminationMySql preliminaryExamination
 	 */
	public function update($preliminaryExamination){
		$sql = 'UPDATE preliminary_examination SET visit_id = ?, harmon_distance_id = ?, convergence_bris_distancte = ?, convergence_recoverement = ?, convergence_xy = ?, stereoacuity_wirt_test = ?, ocular_motility = ? WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($preliminaryExamination->visitId);
		$sqlQuery->setNumber($preliminaryExamination->harmonDistanceId);
		$sqlQuery->set($preliminaryExamination->convergenceBrisDistancte);
		$sqlQuery->set($preliminaryExamination->convergenceRecoverement);
		$sqlQuery->set($preliminaryExamination->convergenceXy);
		$sqlQuery->set($preliminaryExamination->stereoacuityWirtTest);
		$sqlQuery->setNumber($preliminaryExamination->ocularMotility);

		$sqlQuery->setNumber($preliminaryExamination->preliminaryExaminationId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM preliminary_examination';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "preliminary_examination_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM preliminary_examination WHERE preliminary_examination_id = :preliminary_examination_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM preliminary_examination WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $preliminary_examination)
	{
	    try {
	        $data = $this->object_to_array($preliminary_examination);
	        return $pdo->insert('preliminary_examination', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $preliminary_examination, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($preliminary_examination);
	        return $pdo->update('preliminary_examination', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('preliminary_examination', $where, $limit);
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
	
	public function object_to_array($preliminaryExamination)
	{
	    $data = array(
		'preliminary_examination_id'=>$preliminaryExamination->preliminaryExaminationId,
		'visit_id'=>$preliminaryExamination->visitId,
		'harmon_distance_id'=>$preliminaryExamination->harmonDistanceId,
		'convergence_bris_distance'=>$preliminaryExamination->convergenceBrisDistance,
		'convergence_recoverement'=>$preliminaryExamination->convergenceRecoverement,
		'convergence_xy'=>$preliminaryExamination->convergenceXy,
		'stereoacuity_wirt_test'=>$preliminaryExamination->stereoacuityWirtTest,
		'ocular_motility'=>$preliminaryExamination->ocularMotility
	    );
	    return $data;
	}
	
	

	public function queryByVisitId($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHarmonDistanceId($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE harmon_distance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByConvergenceBrisDistancte($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE convergence_bris_distancte = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByConvergenceRecoverement($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE convergence_recoverement = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByConvergenceXy($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE convergence_xy = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStereoacuityWirtTest($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE stereoacuity_wirt_test = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByOcularMotility($value){
		$sql = 'SELECT * FROM preliminary_examination WHERE ocular_motility = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByVisitId($value){
		$sql = 'DELETE FROM preliminary_examination WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHarmonDistanceId($value){
		$sql = 'DELETE FROM preliminary_examination WHERE harmon_distance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByConvergenceBrisDistancte($value){
		$sql = 'DELETE FROM preliminary_examination WHERE convergence_bris_distancte = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByConvergenceRecoverement($value){
		$sql = 'DELETE FROM preliminary_examination WHERE convergence_recoverement = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByConvergenceXy($value){
		$sql = 'DELETE FROM preliminary_examination WHERE convergence_xy = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStereoacuityWirtTest($value){
		$sql = 'DELETE FROM preliminary_examination WHERE stereoacuity_wirt_test = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByOcularMotility($value){
		$sql = 'DELETE FROM preliminary_examination WHERE ocular_motility = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PreliminaryExaminationMySql 
	 */
	protected function readRow($row){
		$preliminaryExamination = new PreliminaryExamination();
		
		$preliminaryExamination->preliminaryExaminationId = $row['preliminary_examination_id'];
		$preliminaryExamination->visitId = $row['visit_id'];
		$preliminaryExamination->harmonDistanceId = $row['harmon_distance_id'];
		$preliminaryExamination->convergenceBrisDistance = $row['convergence_bris_distance'];
		$preliminaryExamination->convergenceRecoverement = $row['convergence_recoverement'];
		$preliminaryExamination->convergenceXy = $row['convergence_xy'];
		$preliminaryExamination->stereoacuityWirtTest = $row['stereoacuity_wirt_test'];
		$preliminaryExamination->ocularMotility = $row['ocular_motility'];

		return $preliminaryExamination;
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
	 * @return PreliminaryExaminationMySql 
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