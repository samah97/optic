<?php
/**
 * Class that operate on table 'pupillary_reflexs'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PupillaryReflexsMySqlDAO implements PupillaryReflexsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PupillaryReflexsMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM pupillary_reflexs WHERE pupillary_reflexs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM pupillary_reflexs';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM pupillary_reflexs ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param pupillaryReflex primary key
 	 */
	public function delete($pupillary_reflexs_id){
		$sql = 'DELETE FROM pupillary_reflexs WHERE pupillary_reflexs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($pupillary_reflexs_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PupillaryReflexsMySql pupillaryReflex
 	 */
	public function insert($pupillaryReflex){
		$sql = 'INSERT INTO pupillary_reflexs (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pupillaryReflex->title);

		$id = $this->executeInsert($sqlQuery);	
		$pupillaryReflex->pupillaryReflexsId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PupillaryReflexsMySql pupillaryReflex
 	 */
	public function update($pupillaryReflex){
		$sql = 'UPDATE pupillary_reflexs SET title = ? WHERE pupillary_reflexs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pupillaryReflex->title);

		$sqlQuery->setNumber($pupillaryReflex->pupillaryReflexsId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM pupillary_reflexs';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "pupillary_reflexs_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM pupillary_reflexs WHERE pupillary_reflexs_id = :pupillary_reflexs_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM pupillary_reflexs WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $pupillary_reflexs)
	{
	    try {
	        $data = $this->object_to_array($pupillary_reflexs);
	        return $pdo->insert('pupillary_reflexs', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $pupillary_reflexs, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($pupillary_reflexs);
	        return $pdo->update('pupillary_reflexs', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('pupillary_reflexs', $where, $limit);
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
	
	public function object_to_array($pupillaryReflex)
	{
	    $data = array(
		'pupillary_reflexs_id'=>$pupillaryReflex->pupillaryReflexsId,
		'title'=>$pupillaryReflex->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM pupillary_reflexs WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM pupillary_reflexs WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PupillaryReflexsMySql 
	 */
	protected function readRow($row){
		$pupillaryReflex = new PupillaryReflex();
		
		$pupillaryReflex->pupillaryReflexsId = $row['pupillary_reflexs_id'];
		$pupillaryReflex->title = $row['title'];

		return $pupillaryReflex;
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
	 * @return PupillaryReflexsMySql 
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