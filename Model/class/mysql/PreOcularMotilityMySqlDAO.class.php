<?php
/**
 * Class that operate on table 'pre_ocular_motility'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PreOcularMotilityMySqlDAO implements PreOcularMotilityDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PreOcularMotilityMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM pre_ocular_motility WHERE ocular_motility_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM pre_ocular_motility';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM pre_ocular_motility ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param preOcularMotility primary key
 	 */
	public function delete($ocular_motility_id){
		$sql = 'DELETE FROM pre_ocular_motility WHERE ocular_motility_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ocular_motility_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PreOcularMotilityMySql preOcularMotility
 	 */
	public function insert($preOcularMotility){
		$sql = 'INSERT INTO pre_ocular_motility (preliminary_examination_id) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($preOcularMotility->preliminaryExaminationId);

		$id = $this->executeInsert($sqlQuery);	
		$preOcularMotility->ocularMotilityId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PreOcularMotilityMySql preOcularMotility
 	 */
	public function update($preOcularMotility){
		$sql = 'UPDATE pre_ocular_motility SET preliminary_examination_id = ? WHERE ocular_motility_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($preOcularMotility->preliminaryExaminationId);

		$sqlQuery->setNumber($preOcularMotility->ocularMotilityId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM pre_ocular_motility';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "ocular_motility_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM pre_ocular_motility WHERE ocular_motility_id = :ocular_motility_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM pre_ocular_motility WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $pre_ocular_motility)
	{
	    try {
	        $data = $this->object_to_array($pre_ocular_motility);
	        return $pdo->insert('pre_ocular_motility', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $pre_ocular_motility, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($pre_ocular_motility);
	        return $pdo->update('pre_ocular_motility', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('pre_ocular_motility', $where, $limit);
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
	
	public function object_to_array($preOcularMotility)
	{
	    $data = array(
		'ocular_motility_id'=>$preOcularMotility->ocularMotilityId,
		'preliminary_examination_id'=>$preOcularMotility->preliminaryExaminationId
	    );
	    return $data;
	}
	
	

	public function queryByPreliminaryExaminationId($value){
		$sql = 'SELECT * FROM pre_ocular_motility WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPreliminaryExaminationId($value){
		$sql = 'DELETE FROM pre_ocular_motility WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PreOcularMotilityMySql 
	 */
	protected function readRow($row){
		$preOcularMotility = new PreOcularMotility();
		
		$preOcularMotility->ocularMotilityId = $row['ocular_motility_id'];
		$preOcularMotility->preliminaryExaminationId = $row['preliminary_examination_id'];

		return $preOcularMotility;
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
	 * @return PreOcularMotilityMySql 
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