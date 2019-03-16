<?php
/**
 * Class that operate on table 'ocular_motility'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class OcularMotilityMySqlDAO implements OcularMotilityDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return OcularMotilityMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM ocular_motility WHERE ocular_motility_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM ocular_motility';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM ocular_motility ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param ocularMotility primary key
 	 */
	public function delete($ocular_motility_id){
		$sql = 'DELETE FROM ocular_motility WHERE ocular_motility_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ocular_motility_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param OcularMotilityMySql ocularMotility
 	 */
	public function insert($ocularMotility){
		$sql = 'INSERT INTO ocular_motility (image, position) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($ocularMotility->image);
		$sqlQuery->set($ocularMotility->position);

		$id = $this->executeInsert($sqlQuery);	
		$ocularMotility->ocularMotilityId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param OcularMotilityMySql ocularMotility
 	 */
	public function update($ocularMotility){
		$sql = 'UPDATE ocular_motility SET image = ?, position = ? WHERE ocular_motility_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($ocularMotility->image);
		$sqlQuery->set($ocularMotility->position);

		$sqlQuery->setNumber($ocularMotility->ocularMotilityId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM ocular_motility';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "ocular_motility_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM ocular_motility WHERE ocular_motility_id = :ocular_motility_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM ocular_motility WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $ocular_motility)
	{
	    try {
	        $data = $this->object_to_array($ocular_motility);
	        return $pdo->insert('ocular_motility', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $ocular_motility, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($ocular_motility);
	        return $pdo->update('ocular_motility', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('ocular_motility', $where, $limit);
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
	
	public function object_to_array($ocularMotility)
	{
	    $data = array(
		'ocular_motility_id'=>$ocularMotility->ocularMotilityId,
		'image'=>$ocularMotility->image,
		'position'=>$ocularMotility->position
	    );
	    return $data;
	}
	
	

	public function queryByImage($value){
		$sql = 'SELECT * FROM ocular_motility WHERE image = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPosition($value){
		$sql = 'SELECT * FROM ocular_motility WHERE position = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByImage($value){
		$sql = 'DELETE FROM ocular_motility WHERE image = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPosition($value){
		$sql = 'DELETE FROM ocular_motility WHERE position = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return OcularMotilityMySql 
	 */
	protected function readRow($row){
		$ocularMotility = new OcularMotility();
		
		$ocularMotility->ocularMotilityId = $row['ocular_motility_id'];
		$ocularMotility->image = $row['image'];
		$ocularMotility->position = $row['position'];

		return $ocularMotility;
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
	 * @return OcularMotilityMySql 
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