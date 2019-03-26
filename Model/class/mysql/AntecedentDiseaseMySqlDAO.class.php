<?php
/**
 * Class that operate on table 'antecedent_disease'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class AntecedentDiseaseMySqlDAO implements AntecedentDiseaseDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return AntecedentDiseaseMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM antecedent_disease WHERE antecedent_disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM antecedent_disease';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM antecedent_disease ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param antecedentDisease primary key
 	 */
	public function delete($antecedent_disease_id){
		$sql = 'DELETE FROM antecedent_disease WHERE antecedent_disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($antecedent_disease_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AntecedentDiseaseMySql antecedentDisease
 	 */
	public function insert($antecedentDisease){
		$sql = 'INSERT INTO antecedent_disease (disease_id, visual_antecedent_id) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($antecedentDisease->diseaseId);
		$sqlQuery->setNumber($antecedentDisease->visualAntecedentId);

		$id = $this->executeInsert($sqlQuery);	
		$antecedentDisease->antecedentDiseaseId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param AntecedentDiseaseMySql antecedentDisease
 	 */
	public function update($antecedentDisease){
		$sql = 'UPDATE antecedent_disease SET disease_id = ?, visual_antecedent_id = ? WHERE antecedent_disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($antecedentDisease->diseaseId);
		$sqlQuery->setNumber($antecedentDisease->visualAntecedentId);

		$sqlQuery->setNumber($antecedentDisease->antecedentDiseaseId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM antecedent_disease';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "antecedent_disease_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM antecedent_disease WHERE antecedent_disease_id = :antecedent_disease_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM antecedent_disease WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $antecedent_disease)
	{
	    try {
	        $data = $this->object_to_array($antecedent_disease);
	        return $pdo->insert('antecedent_disease', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $antecedent_disease, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($antecedent_disease);
	        return $pdo->update('antecedent_disease', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('antecedent_disease', $where, $limit);
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
	
	public function object_to_array($antecedentDisease)
	{
	    $data = array(
		'antecedent_disease_id'=>$antecedentDisease->antecedentDiseaseId,
		'disease_id'=>$antecedentDisease->diseaseId,
		'visual_antecedent_id'=>$antecedentDisease->visualAntecedentId
	    );
	    return $data;
	}
	
	

	public function queryByDiseaseId($value){
		$sql = 'SELECT * FROM antecedent_disease WHERE disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByVisualAntecedentId($value){
		$sql = 'SELECT * FROM antecedent_disease WHERE visual_antecedent_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDiseaseId($value){
		$sql = 'DELETE FROM antecedent_disease WHERE disease_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByVisualAntecedentId($value){
		$sql = 'DELETE FROM antecedent_disease WHERE visual_antecedent_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return AntecedentDiseaseMySql 
	 */
	protected function readRow($row){
		$antecedentDisease = new AntecedentDisease();
		
		$antecedentDisease->antecedentDiseaseId = $row['antecedent_disease_id'];
		$antecedentDisease->diseaseId = $row['disease_id'];
		$antecedentDisease->visualAntecedentId = $row['visual_antecedent_id'];

		return $antecedentDisease;
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
	 * @return AntecedentDiseaseMySql 
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