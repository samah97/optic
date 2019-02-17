<?php
/**
 * Class that operate on table 'type_correction'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class TypeCorrectionMySqlDAO implements TypeCorrectionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TypeCorrectionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM type_correction WHERE type_correction_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM type_correction';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM type_correction ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param typeCorrection primary key
 	 */
	public function delete($type_correction_id){
		$sql = 'DELETE FROM type_correction WHERE type_correction_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($type_correction_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TypeCorrectionMySql typeCorrection
 	 */
	public function insert($typeCorrection){
		$sql = 'INSERT INTO type_correction (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($typeCorrection->title);

		$id = $this->executeInsert($sqlQuery);	
		$typeCorrection->typeCorrectionId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TypeCorrectionMySql typeCorrection
 	 */
	public function update($typeCorrection){
		$sql = 'UPDATE type_correction SET title = ? WHERE type_correction_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($typeCorrection->title);

		$sqlQuery->setNumber($typeCorrection->typeCorrectionId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM type_correction';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "type_correction_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM type_correction WHERE type_correction_id = :type_correction_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM type_correction WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $type_correction)
	{
	    try {
	        $data = $this->object_to_array($type_correction);
	        return $pdo->insert('type_correction', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $type_correction, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($type_correction);
	        return $pdo->update('type_correction', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('type_correction', $where, $limit);
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
	
	public function object_to_array($typeCorrection)
	{
	    $data = array(
		'type_correction_id'=>$typeCorrection->typeCorrectionId,
		'title'=>$typeCorrection->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM type_correction WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM type_correction WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return TypeCorrectionMySql 
	 */
	protected function readRow($row){
		$typeCorrection = new TypeCorrection();
		
		$typeCorrection->typeCorrectionId = $row['type_correction_id'];
		$typeCorrection->title = $row['title'];

		return $typeCorrection;
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
	 * @return TypeCorrectionMySql 
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