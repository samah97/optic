<?php
/**
 * Class that operate on table 'disease'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class DiseaseMySqlDAO implements DiseaseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return DiseaseMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM disease WHERE disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM disease';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM disease ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param disease primary key
 	 */
	public function delete($disease_id){
		$sql = 'DELETE FROM disease WHERE disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($disease_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param DiseaseMySql disease
 	 */
	public function insert($disease){
		$sql = 'INSERT INTO disease (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($disease->title);

		$id = $this->executeInsert($sqlQuery);	
		$disease->diseaseId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param DiseaseMySql disease
 	 */
	public function update($disease){
		$sql = 'UPDATE disease SET title = ? WHERE disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($disease->title);

		$sqlQuery->setNumber($disease->diseaseId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM disease';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "disease_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM disease WHERE disease_id = :disease_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM disease WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $disease)
	{
	    try {
	        $data = $this->object_to_array($disease);
	        return $pdo->insert('disease', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $disease, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($disease);
	        return $pdo->update('disease', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('disease', $where, $limit);
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
	
	public function object_to_array($disease)
	{
	    $data = array(
		'disease_id'=>$disease->diseaseId,
		'title'=>$disease->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM disease WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM disease WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return DiseaseMySql 
	 */
	protected function readRow($row){
		$disease = new Disease();
		
		$disease->diseaseId = $row['disease_id'];
		$disease->title = $row['title'];

		return $disease;
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
	 * @return DiseaseMySql 
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