<?php
/**
 * Class that operate on table 'pre_cover_test'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PreCoverTestMySqlDAO implements PreCoverTestDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PreCoverTestMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM pre_cover_test WHERE cover_test_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM pre_cover_test';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM pre_cover_test ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param preCoverTest primary key
 	 */
	public function delete($cover_test_id){
		$sql = 'DELETE FROM pre_cover_test WHERE cover_test_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cover_test_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PreCoverTestMySql preCoverTest
 	 */
	public function insert($preCoverTest){
		$sql = 'INSERT INTO pre_cover_test (preliminary_examination_id) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($preCoverTest->preliminaryExaminationId);

		$id = $this->executeInsert($sqlQuery);	
		$preCoverTest->coverTestId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PreCoverTestMySql preCoverTest
 	 */
	public function update($preCoverTest){
		$sql = 'UPDATE pre_cover_test SET preliminary_examination_id = ? WHERE cover_test_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($preCoverTest->preliminaryExaminationId);

		$sqlQuery->setNumber($preCoverTest->coverTestId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM pre_cover_test';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "cover_test_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM pre_cover_test WHERE cover_test_id = :cover_test_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM pre_cover_test WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $pre_cover_test)
	{
	    try {
	        $data = $this->object_to_array($pre_cover_test);
	        return $pdo->insert('pre_cover_test', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $pre_cover_test, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($pre_cover_test);
	        return $pdo->update('pre_cover_test', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('pre_cover_test', $where, $limit);
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
	
	public function object_to_array($preCoverTest)
	{
	    $data = array(
		'cover_test_id'=>$preCoverTest->coverTestId,
		'preliminary_examination_id'=>$preCoverTest->preliminaryExaminationId
	    );
	    return $data;
	}
	
	

	public function queryByPreliminaryExaminationId($value){
		$sql = 'SELECT * FROM pre_cover_test WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPreliminaryExaminationId($value){
		$sql = 'DELETE FROM pre_cover_test WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PreCoverTestMySql 
	 */
	protected function readRow($row){
		$preCoverTest = new PreCoverTest();
		
		$preCoverTest->coverTestId = $row['cover_test_id'];
		$preCoverTest->preliminaryExaminationId = $row['preliminary_examination_id'];

		return $preCoverTest;
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
	 * @return PreCoverTestMySql 
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