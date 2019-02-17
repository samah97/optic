<?php
/**
 * Class that operate on table 'visual_need'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualNeedMySqlDAO implements VisualNeedDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return VisualNeedMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM visual_need WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM visual_need';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM visual_need ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param visualNeed primary key
 	 */
	public function delete($visual_need_id){
		$sql = 'DELETE FROM visual_need WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($visual_need_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisualNeedMySql visualNeed
 	 */
	public function insert($visualNeed){
		$sql = 'INSERT INTO visual_need (visit_id, is_far, is_near, is_partially, is_fully, task_duration, work_distance, work_station_id, lighting, is_need_color, ambiance_id, ambiance_other, is_trauma_risk, description, extra_proffession_activity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($visualNeed->visitId);
		$sqlQuery->setNumber($visualNeed->isFar);
		$sqlQuery->setNumber($visualNeed->isNear);
		$sqlQuery->setNumber($visualNeed->isPartially);
		$sqlQuery->setNumber($visualNeed->isFully);
		$sqlQuery->set($visualNeed->taskDuration);
		$sqlQuery->set($visualNeed->workDistance);
		$sqlQuery->setNumber($visualNeed->workStationId);
		$sqlQuery->set($visualNeed->lighting);
		$sqlQuery->setNumber($visualNeed->isNeedColor);
		$sqlQuery->setNumber($visualNeed->ambianceId);
		$sqlQuery->set($visualNeed->ambianceOther);
		$sqlQuery->setNumber($visualNeed->isTraumaRisk);
		$sqlQuery->set($visualNeed->description);
		$sqlQuery->set($visualNeed->extraProffessionActivity);

		$id = $this->executeInsert($sqlQuery);	
		$visualNeed->visualNeedId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisualNeedMySql visualNeed
 	 */
	public function update($visualNeed){
		$sql = 'UPDATE visual_need SET visit_id = ?, is_far = ?, is_near = ?, is_partially = ?, is_fully = ?, task_duration = ?, work_distance = ?, work_station_id = ?, lighting = ?, is_need_color = ?, ambiance_id = ?, ambiance_other = ?, is_trauma_risk = ?, description = ?, extra_proffession_activity = ? WHERE visual_need_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($visualNeed->visitId);
		$sqlQuery->setNumber($visualNeed->isFar);
		$sqlQuery->setNumber($visualNeed->isNear);
		$sqlQuery->setNumber($visualNeed->isPartially);
		$sqlQuery->setNumber($visualNeed->isFully);
		$sqlQuery->set($visualNeed->taskDuration);
		$sqlQuery->set($visualNeed->workDistance);
		$sqlQuery->setNumber($visualNeed->workStationId);
		$sqlQuery->set($visualNeed->lighting);
		$sqlQuery->setNumber($visualNeed->isNeedColor);
		$sqlQuery->setNumber($visualNeed->ambianceId);
		$sqlQuery->set($visualNeed->ambianceOther);
		$sqlQuery->setNumber($visualNeed->isTraumaRisk);
		$sqlQuery->set($visualNeed->description);
		$sqlQuery->set($visualNeed->extraProffessionActivity);

		$sqlQuery->setNumber($visualNeed->visualNeedId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM visual_need';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "visual_need_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM visual_need WHERE visual_need_id = :visual_need_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM visual_need WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $visual_need)
	{
	    try {
	        $data = $this->object_to_array($visual_need);
	        return $pdo->insert('visual_need', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $visual_need, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($visual_need);
	        return $pdo->update('visual_need', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('visual_need', $where, $limit);
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
	
	public function object_to_array($visualNeed)
	{
	    $data = array(
		'visual_need_id'=>$visualNeed->visualNeedId,
		'visit_id'=>$visualNeed->visitId,
		'is_far'=>$visualNeed->isFar,
		'is_near'=>$visualNeed->isNear,
		'is_partially'=>$visualNeed->isPartially,
		'is_fully'=>$visualNeed->isFully,
		'task_duration'=>$visualNeed->taskDuration,
		'work_distance'=>$visualNeed->workDistance,
		'work_station_id'=>$visualNeed->workStationId,
		'lighting'=>$visualNeed->lighting,
		'is_need_color'=>$visualNeed->isNeedColor,
		'ambiance_id'=>$visualNeed->ambianceId,
		'ambiance_other'=>$visualNeed->ambianceOther,
		'is_trauma_risk'=>$visualNeed->isTraumaRisk,
		'description'=>$visualNeed->description,
		'extra_proffession_activity'=>$visualNeed->extraProffessionActivity
	    );
	    return $data;
	}
	
	

	public function queryByVisitId($value){
		$sql = 'SELECT * FROM visual_need WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsFar($value){
		$sql = 'SELECT * FROM visual_need WHERE is_far = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsNear($value){
		$sql = 'SELECT * FROM visual_need WHERE is_near = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsPartially($value){
		$sql = 'SELECT * FROM visual_need WHERE is_partially = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsFully($value){
		$sql = 'SELECT * FROM visual_need WHERE is_fully = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTaskDuration($value){
		$sql = 'SELECT * FROM visual_need WHERE task_duration = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByWorkDistance($value){
		$sql = 'SELECT * FROM visual_need WHERE work_distance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByWorkStationId($value){
		$sql = 'SELECT * FROM visual_need WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLighting($value){
		$sql = 'SELECT * FROM visual_need WHERE lighting = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsNeedColor($value){
		$sql = 'SELECT * FROM visual_need WHERE is_need_color = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAmbianceId($value){
		$sql = 'SELECT * FROM visual_need WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAmbianceOther($value){
		$sql = 'SELECT * FROM visual_need WHERE ambiance_other = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByIsTraumaRisk($value){
		$sql = 'SELECT * FROM visual_need WHERE is_trauma_risk = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDescription($value){
		$sql = 'SELECT * FROM visual_need WHERE description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByExtraProffessionActivity($value){
		$sql = 'SELECT * FROM visual_need WHERE extra_proffession_activity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByVisitId($value){
		$sql = 'DELETE FROM visual_need WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsFar($value){
		$sql = 'DELETE FROM visual_need WHERE is_far = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsNear($value){
		$sql = 'DELETE FROM visual_need WHERE is_near = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsPartially($value){
		$sql = 'DELETE FROM visual_need WHERE is_partially = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsFully($value){
		$sql = 'DELETE FROM visual_need WHERE is_fully = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTaskDuration($value){
		$sql = 'DELETE FROM visual_need WHERE task_duration = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByWorkDistance($value){
		$sql = 'DELETE FROM visual_need WHERE work_distance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByWorkStationId($value){
		$sql = 'DELETE FROM visual_need WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLighting($value){
		$sql = 'DELETE FROM visual_need WHERE lighting = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsNeedColor($value){
		$sql = 'DELETE FROM visual_need WHERE is_need_color = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAmbianceId($value){
		$sql = 'DELETE FROM visual_need WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAmbianceOther($value){
		$sql = 'DELETE FROM visual_need WHERE ambiance_other = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByIsTraumaRisk($value){
		$sql = 'DELETE FROM visual_need WHERE is_trauma_risk = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDescription($value){
		$sql = 'DELETE FROM visual_need WHERE description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByExtraProffessionActivity($value){
		$sql = 'DELETE FROM visual_need WHERE extra_proffession_activity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return VisualNeedMySql 
	 */
	protected function readRow($row){
		$visualNeed = new VisualNeed();
		
		$visualNeed->visualNeedId = $row['visual_need_id'];
		$visualNeed->visitId = $row['visit_id'];
		$visualNeed->isFar = $row['is_far'];
		$visualNeed->isNear = $row['is_near'];
		$visualNeed->isPartially = $row['is_partially'];
		$visualNeed->isFully = $row['is_fully'];
		$visualNeed->taskDuration = $row['task_duration'];
		$visualNeed->workDistance = $row['work_distance'];
		$visualNeed->workStationId = $row['work_station_id'];
		$visualNeed->lighting = $row['lighting'];
		$visualNeed->isNeedColor = $row['is_need_color'];
		$visualNeed->ambianceId = $row['ambiance_id'];
		$visualNeed->ambianceOther = $row['ambiance_other'];
		$visualNeed->isTraumaRisk = $row['is_trauma_risk'];
		$visualNeed->description = $row['description'];
		$visualNeed->extraProffessionActivity = $row['extra_proffession_activity'];

		return $visualNeed;
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
	 * @return VisualNeedMySql 
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