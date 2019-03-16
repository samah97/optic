<?php
/**
 * Class that operate on table 'pre_pupillary_reflexs'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PrePupillaryReflexsMySqlDAO implements PrePupillaryReflexsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PrePupillaryReflexsMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM pre_pupillary_reflexs WHERE pupillary_reflexs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM pre_pupillary_reflexs';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM pre_pupillary_reflexs ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param prePupillaryReflex primary key
 	 */
	public function delete($pupillary_reflexs_id){
		$sql = 'DELETE FROM pre_pupillary_reflexs WHERE pupillary_reflexs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($pupillary_reflexs_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PrePupillaryReflexsMySql prePupillaryReflex
 	 */
	public function insert($prePupillaryReflex){
		$sql = 'INSERT INTO pre_pupillary_reflexs (prelimary_examination_id, text) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($prePupillaryReflex->prelimaryExaminationId);
		$sqlQuery->set($prePupillaryReflex->text);

		$id = $this->executeInsert($sqlQuery);	
		$prePupillaryReflex->pupillaryReflexsId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PrePupillaryReflexsMySql prePupillaryReflex
 	 */
	public function update($prePupillaryReflex){
		$sql = 'UPDATE pre_pupillary_reflexs SET prelimary_examination_id = ?, text = ? WHERE pupillary_reflexs_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($prePupillaryReflex->prelimaryExaminationId);
		$sqlQuery->set($prePupillaryReflex->text);

		$sqlQuery->setNumber($prePupillaryReflex->pupillaryReflexsId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM pre_pupillary_reflexs';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "pupillary_reflexs_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM pre_pupillary_reflexs WHERE pupillary_reflexs_id = :pupillary_reflexs_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM pre_pupillary_reflexs WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $pre_pupillary_reflexs)
	{
	    try {
	        $data = $this->object_to_array($pre_pupillary_reflexs);
	        return $pdo->insert('pre_pupillary_reflexs', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $pre_pupillary_reflexs, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($pre_pupillary_reflexs);
	        return $pdo->update('pre_pupillary_reflexs', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('pre_pupillary_reflexs', $where, $limit);
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
	
	public function object_to_array($prePupillaryReflex)
	{
	    $data = array(
		'pupillary_reflexs_id'=>$prePupillaryReflex->pupillaryReflexsId,
		'prelimary_examination_id'=>$prePupillaryReflex->prelimaryExaminationId,
		'text'=>$prePupillaryReflex->text
	    );
	    return $data;
	}
	
	

	public function queryByPrelimaryExaminationId($value){
		$sql = 'SELECT * FROM pre_pupillary_reflexs WHERE prelimary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByText($value){
		$sql = 'SELECT * FROM pre_pupillary_reflexs WHERE text = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPrelimaryExaminationId($value){
		$sql = 'DELETE FROM pre_pupillary_reflexs WHERE prelimary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByText($value){
		$sql = 'DELETE FROM pre_pupillary_reflexs WHERE text = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PrePupillaryReflexsMySql 
	 */
	protected function readRow($row){
		$prePupillaryReflex = new PrePupillaryReflex();
		
		$prePupillaryReflex->pupillaryReflexsId = $row['pupillary_reflexs_id'];
		$prePupillaryReflex->prelimaryExaminationId = $row['prelimary_examination_id'];
		$prePupillaryReflex->text = $row['text'];

		return $prePupillaryReflex;
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
	 * @return PrePupillaryReflexsMySql 
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