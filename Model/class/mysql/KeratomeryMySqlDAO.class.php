<?php
/**
 * Class that operate on table 'keratomery'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class KeratomeryMySqlDAO implements KeratomeryDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return KeratomeryMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM keratomery WHERE keratomery_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM keratomery';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM keratomery ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param keratomery primary key
 	 */
	public function delete($keratomery_id){
		$sql = 'DELETE FROM keratomery WHERE keratomery_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($keratomery_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param KeratomeryMySql keratomery
 	 */
	public function insert($keratomery){
		$sql = 'INSERT INTO keratomery (first_mer_od, first_axis_od, second_mer_od, second_axis_od, anterior_astigmation_od, first_mer_os, first_axis_os, second_mer_os, second_axis_os, anterior_astigmation_os, preliminary_examination_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($keratomery->firstMerOd);
		$sqlQuery->set($keratomery->firstAxisOd);
		$sqlQuery->set($keratomery->secondMerOd);
		$sqlQuery->set($keratomery->secondAxisOd);
		$sqlQuery->set($keratomery->anteriorAstigmationOd);
		$sqlQuery->set($keratomery->firstMerOs);
		$sqlQuery->set($keratomery->firstAxisOs);
		$sqlQuery->set($keratomery->secondMerOs);
		$sqlQuery->set($keratomery->secondAxisOs);
		$sqlQuery->set($keratomery->anteriorAstigmationOs);
		$sqlQuery->setNumber($keratomery->preliminaryExaminationId);

		$id = $this->executeInsert($sqlQuery);	
		$keratomery->keratomeryId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param KeratomeryMySql keratomery
 	 */
	public function update($keratomery){
		$sql = 'UPDATE keratomery SET first_mer_od = ?, first_axis_od = ?, second_mer_od = ?, second_axis_od = ?, anterior_astigmation_od = ?, first_mer_os = ?, first_axis_os = ?, second_mer_os = ?, second_axis_os = ?, anterior_astigmation_os = ?, preliminary_examination_id = ? WHERE keratomery_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($keratomery->firstMerOd);
		$sqlQuery->set($keratomery->firstAxisOd);
		$sqlQuery->set($keratomery->secondMerOd);
		$sqlQuery->set($keratomery->secondAxisOd);
		$sqlQuery->set($keratomery->anteriorAstigmationOd);
		$sqlQuery->set($keratomery->firstMerOs);
		$sqlQuery->set($keratomery->firstAxisOs);
		$sqlQuery->set($keratomery->secondMerOs);
		$sqlQuery->set($keratomery->secondAxisOs);
		$sqlQuery->set($keratomery->anteriorAstigmationOs);
		$sqlQuery->setNumber($keratomery->preliminaryExaminationId);

		$sqlQuery->setNumber($keratomery->keratomeryId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM keratomery';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "keratomery_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM keratomery WHERE keratomery_id = :keratomery_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM keratomery WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $keratomery)
	{
	    try {
	        $data = $this->object_to_array($keratomery);
	        return $pdo->insert('keratomery', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $keratomery, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($keratomery);
	        return $pdo->update('keratomery', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('keratomery', $where, $limit);
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
	
	public function object_to_array($keratomery)
	{
	    $data = array(
		'keratomery_id'=>$keratomery->keratomeryId,
		'first_mer_od'=>$keratomery->firstMerOd,
		'first_axis_od'=>$keratomery->firstAxisOd,
		'second_mer_od'=>$keratomery->secondMerOd,
		'second_axis_od'=>$keratomery->secondAxisOd,
		'anterior_astigmation_od'=>$keratomery->anteriorAstigmationOd,
		'first_mer_os'=>$keratomery->firstMerOs,
		'first_axis_os'=>$keratomery->firstAxisOs,
		'second_mer_os'=>$keratomery->secondMerOs,
		'second_axis_os'=>$keratomery->secondAxisOs,
		'anterior_astigmation_os'=>$keratomery->anteriorAstigmationOs,
		'preliminary_examination_id'=>$keratomery->preliminaryExaminationId
	    );
	    return $data;
	}
	
	

	public function queryByFirstMerOd($value){
		$sql = 'SELECT * FROM keratomery WHERE first_mer_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFirstAxisOd($value){
		$sql = 'SELECT * FROM keratomery WHERE first_axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySecondMerOd($value){
		$sql = 'SELECT * FROM keratomery WHERE second_mer_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySecondAxisOd($value){
		$sql = 'SELECT * FROM keratomery WHERE second_axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAnteriorAstigmationOd($value){
		$sql = 'SELECT * FROM keratomery WHERE anterior_astigmation_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFirstMerOs($value){
		$sql = 'SELECT * FROM keratomery WHERE first_mer_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFirstAxisOs($value){
		$sql = 'SELECT * FROM keratomery WHERE first_axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySecondMerOs($value){
		$sql = 'SELECT * FROM keratomery WHERE second_mer_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySecondAxisOs($value){
		$sql = 'SELECT * FROM keratomery WHERE second_axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAnteriorAstigmationOs($value){
		$sql = 'SELECT * FROM keratomery WHERE anterior_astigmation_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPreliminaryExaminationId($value){
		$sql = 'SELECT * FROM keratomery WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByFirstMerOd($value){
		$sql = 'DELETE FROM keratomery WHERE first_mer_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFirstAxisOd($value){
		$sql = 'DELETE FROM keratomery WHERE first_axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySecondMerOd($value){
		$sql = 'DELETE FROM keratomery WHERE second_mer_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySecondAxisOd($value){
		$sql = 'DELETE FROM keratomery WHERE second_axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAnteriorAstigmationOd($value){
		$sql = 'DELETE FROM keratomery WHERE anterior_astigmation_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFirstMerOs($value){
		$sql = 'DELETE FROM keratomery WHERE first_mer_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFirstAxisOs($value){
		$sql = 'DELETE FROM keratomery WHERE first_axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySecondMerOs($value){
		$sql = 'DELETE FROM keratomery WHERE second_mer_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySecondAxisOs($value){
		$sql = 'DELETE FROM keratomery WHERE second_axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAnteriorAstigmationOs($value){
		$sql = 'DELETE FROM keratomery WHERE anterior_astigmation_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPreliminaryExaminationId($value){
		$sql = 'DELETE FROM keratomery WHERE preliminary_examination_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return KeratomeryMySql 
	 */
	protected function readRow($row){
		$keratomery = new Keratomery();
		
		$keratomery->keratomeryId = $row['keratomery_id'];
		$keratomery->firstMerOd = $row['first_mer_od'];
		$keratomery->firstAxisOd = $row['first_axis_od'];
		$keratomery->secondMerOd = $row['second_mer_od'];
		$keratomery->secondAxisOd = $row['second_axis_od'];
		$keratomery->anteriorAstigmationOd = $row['anterior_astigmation_od'];
		$keratomery->firstMerOs = $row['first_mer_os'];
		$keratomery->firstAxisOs = $row['first_axis_os'];
		$keratomery->secondMerOs = $row['second_mer_os'];
		$keratomery->secondAxisOs = $row['second_axis_os'];
		$keratomery->anteriorAstigmationOs = $row['anterior_astigmation_os'];
		$keratomery->preliminaryExaminationId = $row['preliminary_examination_id'];

		return $keratomery;
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
	 * @return KeratomeryMySql 
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