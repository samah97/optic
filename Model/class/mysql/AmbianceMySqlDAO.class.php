<?php
/**
 * Class that operate on table 'ambiance'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class AmbianceMySqlDAO implements AmbianceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return AmbianceMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM ambiance WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM ambiance';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM ambiance ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param ambiance primary key
 	 */
	public function delete($ambiance_id){
		$sql = 'DELETE FROM ambiance WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ambiance_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AmbianceMySql ambiance
 	 */
	public function insert($ambiance){
		$sql = 'INSERT INTO ambiance (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($ambiance->title);

		$id = $this->executeInsert($sqlQuery);	
		$ambiance->ambianceId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param AmbianceMySql ambiance
 	 */
	public function update($ambiance){
		$sql = 'UPDATE ambiance SET title = ? WHERE ambiance_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($ambiance->title);

		$sqlQuery->setNumber($ambiance->ambianceId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM ambiance';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "ambiance_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM ambiance WHERE ambiance_id = :ambiance_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM ambiance WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $ambiance)
	{
	    try {
	        $data = $this->object_to_array($ambiance);
	        return $pdo->insert('ambiance', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $ambiance, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($ambiance);
	        return $pdo->update('ambiance', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('ambiance', $where, $limit);
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
	
	public function object_to_array($ambiance)
	{
	    $data = array(
		'ambiance_id'=>$ambiance->ambianceId,
		'title'=>$ambiance->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM ambiance WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM ambiance WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return AmbianceMySql 
	 */
	protected function readRow($row){
		$ambiance = new Ambiance();
		
		$ambiance->ambianceId = $row['ambiance_id'];
		$ambiance->title = $row['title'];

		return $ambiance;
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
	 * @return AmbianceMySql 
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