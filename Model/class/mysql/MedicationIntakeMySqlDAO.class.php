<?php
/**
 * Class that operate on table 'medication_intake'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-04 22:53
 */
class MedicationIntakeMySqlDAO implements MedicationIntakeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return MedicationIntakeMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM medication_intake WHERE medication_intake_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM medication_intake';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM medication_intake ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param medicationIntake primary key
 	 */
	public function delete($medication_intake_id){
		$sql = 'DELETE FROM medication_intake WHERE medication_intake_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($medication_intake_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MedicationIntakeMySql medicationIntake
 	 */
	public function insert($medicationIntake){
		$sql = 'INSERT INTO medication_intake (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($medicationIntake->title);

		$id = $this->executeInsert($sqlQuery);	
		$medicationIntake->medicationIntakeId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param MedicationIntakeMySql medicationIntake
 	 */
	public function update($medicationIntake){
		$sql = 'UPDATE medication_intake SET title = ? WHERE medication_intake_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($medicationIntake->title);

		$sqlQuery->setNumber($medicationIntake->medicationIntakeId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM medication_intake';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "medication_intake_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM medication_intake WHERE medication_intake_id = :medication_intake_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM medication_intake WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $medication_intake)
	{
	    try {
	        $data = $this->object_to_array($medication_intake);
	        return $pdo->insert('medication_intake', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $medication_intake, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($medication_intake);
	        return $pdo->update('medication_intake', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('medication_intake', $where, $limit);
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
	
	public function object_to_array($medicationIntake)
	{
	    $data = array(
		'medication_intake_id'=>$medicationIntake->medicationIntakeId,
		'title'=>$medicationIntake->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM medication_intake WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM medication_intake WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return MedicationIntakeMySql 
	 */
	protected function readRow($row){
		$medicationIntake = new MedicationIntake();
		
		$medicationIntake->medicationIntakeId = $row['medication_intake_id'];
		$medicationIntake->title = $row['title'];

		return $medicationIntake;
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
	 * @return MedicationIntakeMySql 
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