<?php
/**
 * Class that operate on table 'functional_sign'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class FunctionalSignMySqlDAO implements FunctionalSignDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return FunctionalSignMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM functional_sign WHERE functional_sign_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM functional_sign';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM functional_sign ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param functionalSign primary key
 	 */
	public function delete($functional_sign_id){
		$sql = 'DELETE FROM functional_sign WHERE functional_sign_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($functional_sign_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param FunctionalSignMySql functionalSign
 	 */
	public function insert($functionalSign){
		$sql = 'INSERT INTO functional_sign (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($functionalSign->title);

		$id = $this->executeInsert($sqlQuery);	
		$functionalSign->functionalSignId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param FunctionalSignMySql functionalSign
 	 */
	public function update($functionalSign){
		$sql = 'UPDATE functional_sign SET title = ? WHERE functional_sign_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($functionalSign->title);

		$sqlQuery->setNumber($functionalSign->functionalSignId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM functional_sign';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "functional_sign_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM functional_sign WHERE functional_sign_id = :functional_sign_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM functional_sign WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $functional_sign)
	{
	    try {
	        $data = $this->object_to_array($functional_sign);
	        return $pdo->insert('functional_sign', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $functional_sign, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($functional_sign);
	        return $pdo->update('functional_sign', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('functional_sign', $where, $limit);
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
	
	public function object_to_array($functionalSign)
	{
	    $data = array(
		'functional_sign_id'=>$functionalSign->functionalSignId,
		'title'=>$functionalSign->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM functional_sign WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM functional_sign WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return FunctionalSignMySql 
	 */
	protected function readRow($row){
		$functionalSign = new FunctionalSign();
		
		$functionalSign->functionalSignId = $row['functional_sign_id'];
		$functionalSign->title = $row['title'];

		return $functionalSign;
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
	 * @return FunctionalSignMySql 
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