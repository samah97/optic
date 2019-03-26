<?php
/**
 * Class that operate on table 'work_station'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class WorkStationMySqlDAO implements WorkStationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return WorkStationMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM work_station WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM work_station';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM work_station ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param workStation primary key
 	 */
	public function delete($work_station_id){
		$sql = 'DELETE FROM work_station WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($work_station_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param WorkStationMySql workStation
 	 */
	public function insert($workStation){
		$sql = 'INSERT INTO work_station (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($workStation->title);

		$id = $this->executeInsert($sqlQuery);	
		$workStation->workStationId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param WorkStationMySql workStation
 	 */
	public function update($workStation){
		$sql = 'UPDATE work_station SET title = ? WHERE work_station_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($workStation->title);

		$sqlQuery->setNumber($workStation->workStationId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM work_station';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "work_station_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM work_station WHERE work_station_id = :work_station_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM work_station WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $work_station)
	{
	    try {
	        $data = $this->object_to_array($work_station);
	        return $pdo->insert('work_station', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $work_station, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($work_station);
	        return $pdo->update('work_station', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('work_station', $where, $limit);
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
	
	public function object_to_array($workStation)
	{
	    $data = array(
		'work_station_id'=>$workStation->workStationId,
		'title'=>$workStation->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM work_station WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM work_station WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return WorkStationMySql 
	 */
	protected function readRow($row){
		$workStation = new WorkStation();
		
		$workStation->workStationId = $row['work_station_id'];
		$workStation->title = $row['title'];

		return $workStation;
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
	 * @return WorkStationMySql 
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