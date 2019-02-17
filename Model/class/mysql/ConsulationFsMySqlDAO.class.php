<?php
/**
 * Class that operate on table 'consulation_fs'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ConsulationFsMySqlDAO implements ConsulationFsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ConsulationFsMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM consulation_fs WHERE consulation_fs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM consulation_fs';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM consulation_fs ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param consulationF primary key
 	 */
	public function delete($consulation_fs_id){
		$sql = 'DELETE FROM consulation_fs WHERE consulation_fs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($consulation_fs_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ConsulationFsMySql consulationF
 	 */
	public function insert($consulationF){
		$sql = 'INSERT INTO consulation_fs (reason_consultation_id, function_sign_id) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($consulationF->reasonConsultationId);
		$sqlQuery->setNumber($consulationF->functionSignId);

		$id = $this->executeInsert($sqlQuery);	
		$consulationF->consulationFsId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ConsulationFsMySql consulationF
 	 */
	public function update($consulationF){
		$sql = 'UPDATE consulation_fs SET reason_consultation_id = ?, function_sign_id = ? WHERE consulation_fs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($consulationF->reasonConsultationId);
		$sqlQuery->setNumber($consulationF->functionSignId);

		$sqlQuery->setNumber($consulationF->consulationFsId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM consulation_fs';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "consulation_fs_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM consulation_fs WHERE consulation_fs_id = :consulation_fs_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM consulation_fs WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $consulation_fs)
	{
	    try {
	        $data = $this->object_to_array($consulation_fs);
	        return $pdo->insert('consulation_fs', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $consulation_fs, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($consulation_fs);
	        return $pdo->update('consulation_fs', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('consulation_fs', $where, $limit);
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
	
	public function object_to_array($consulationF)
	{
	    $data = array(
		'consulation_fs_id'=>$consulationF->consulationFsId,
		'reason_consultation_id'=>$consulationF->reasonConsultationId,
		'function_sign_id'=>$consulationF->functionSignId
	    );
	    return $data;
	}
	
	

	public function queryByReasonConsultationId($value){
		$sql = 'SELECT * FROM consulation_fs WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFunctionSignId($value){
		$sql = 'SELECT * FROM consulation_fs WHERE function_sign_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByReasonConsultationId($value){
		$sql = 'DELETE FROM consulation_fs WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFunctionSignId($value){
		$sql = 'DELETE FROM consulation_fs WHERE function_sign_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ConsulationFsMySql 
	 */
	protected function readRow($row){
		$consulationF = new ConsulationF();
		
		$consulationF->consulationFsId = $row['consulation_fs_id'];
		$consulationF->reasonConsultationId = $row['reason_consultation_id'];
		$consulationF->functionSignId = $row['function_sign_id'];

		return $consulationF;
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
	 * @return ConsulationFsMySql 
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