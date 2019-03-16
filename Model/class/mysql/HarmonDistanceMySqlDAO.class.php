<?php
/**
 * Class that operate on table 'harmon_distance'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class HarmonDistanceMySqlDAO implements HarmonDistanceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return HarmonDistanceMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM harmon_distance WHERE harmon_distance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM harmon_distance';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM harmon_distance ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param harmonDistance primary key
 	 */
	public function delete($harmon_distance){
		$sql = 'DELETE FROM harmon_distance WHERE harmon_distance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($harmon_distance);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param HarmonDistanceMySql harmonDistance
 	 */
	public function insert($harmonDistance){
		$sql = 'INSERT INTO harmon_distance (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($harmonDistance->title);

		$id = $this->executeInsert($sqlQuery);	
		$harmonDistance->harmonDistance = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param HarmonDistanceMySql harmonDistance
 	 */
	public function update($harmonDistance){
		$sql = 'UPDATE harmon_distance SET title = ? WHERE harmon_distance = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($harmonDistance->title);

		$sqlQuery->setNumber($harmonDistance->harmonDistance);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM harmon_distance';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "harmon_distance" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM harmon_distance WHERE harmon_distance = :harmon_distance', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM harmon_distance WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $harmon_distance)
	{
	    try {
	        $data = $this->object_to_array($harmon_distance);
	        return $pdo->insert('harmon_distance', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $harmon_distance, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($harmon_distance);
	        return $pdo->update('harmon_distance', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('harmon_distance', $where, $limit);
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
	
	public function object_to_array($harmonDistance)
	{
	    $data = array(
		'harmon_distance'=>$harmonDistance->harmonDistance,
		'title'=>$harmonDistance->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM harmon_distance WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM harmon_distance WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return HarmonDistanceMySql 
	 */
	protected function readRow($row){
		$harmonDistance = new HarmonDistance();
		
		$harmonDistance->harmonDistance = $row['harmon_distance'];
		$harmonDistance->title = $row['title'];

		return $harmonDistance;
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
	 * @return HarmonDistanceMySql 
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