<?php
/**
 * Class that operate on table 'patient_info'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class PatientInfoMySqlDAO implements PatientInfoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PatientInfoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM patient_info WHERE patient_info_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM patient_info';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM patient_info ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param patientInfo primary key
 	 */
	public function delete($patient_info_id){
		$sql = 'DELETE FROM patient_info WHERE patient_info_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($patient_info_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PatientInfoMySql patientInfo
 	 */
	public function insert($patientInfo){
		$sql = 'INSERT INTO patient_info (name, dob, address, phone, genderId, occupation, referred, hobbies) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($patientInfo->name);
		$sqlQuery->set($patientInfo->dob);
		$sqlQuery->set($patientInfo->address);
		$sqlQuery->set($patientInfo->phone);
		$sqlQuery->setNumber($patientInfo->genderId);
		$sqlQuery->set($patientInfo->occupation);
		$sqlQuery->set($patientInfo->referred);
		$sqlQuery->set($patientInfo->hobbies);

		$id = $this->executeInsert($sqlQuery);	
		$patientInfo->patientInfoId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PatientInfoMySql patientInfo
 	 */
	public function update($patientInfo){
		$sql = 'UPDATE patient_info SET name = ?, dob = ?, address = ?, phone = ?, genderId = ?, occupation = ?, referred = ?, hobbies = ? WHERE patient_info_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($patientInfo->name);
		$sqlQuery->set($patientInfo->dob);
		$sqlQuery->set($patientInfo->address);
		$sqlQuery->set($patientInfo->phone);
		$sqlQuery->setNumber($patientInfo->genderId);
		$sqlQuery->set($patientInfo->occupation);
		$sqlQuery->set($patientInfo->referred);
		$sqlQuery->set($patientInfo->hobbies);

		$sqlQuery->setNumber($patientInfo->patientInfoId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM patient_info';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "patient_info_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM patient_info WHERE patient_info_id = :patient_info_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM patient_info WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $patient_info)
	{
	    try {
	        $data = $this->object_to_array($patient_info);
	        return $pdo->insert('patient_info', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $patient_info, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($patient_info);
	        return $pdo->update('patient_info', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('patient_info', $where, $limit);
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
	
	public function object_to_array($patientInfo)
	{
	    $data = array(
		'patient_info_id'=>$patientInfo->patientInfoId,
		'name'=>$patientInfo->name,
		'dob'=>$patientInfo->dob,
		'address'=>$patientInfo->address,
		'phone'=>$patientInfo->phone,
		'genderId'=>$patientInfo->genderId,
		'occupation'=>$patientInfo->occupation,
		'referred'=>$patientInfo->referred,
		'hobbies'=>$patientInfo->hobbies
	    );
	    return $data;
	}
	
	

	public function queryByName($value){
		$sql = 'SELECT * FROM patient_info WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDob($value){
		$sql = 'SELECT * FROM patient_info WHERE dob = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAddress($value){
		$sql = 'SELECT * FROM patient_info WHERE address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPhone($value){
		$sql = 'SELECT * FROM patient_info WHERE phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByGenderId($value){
		$sql = 'SELECT * FROM patient_info WHERE genderId = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByOccupation($value){
		$sql = 'SELECT * FROM patient_info WHERE occupation = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByReferred($value){
		$sql = 'SELECT * FROM patient_info WHERE referred = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHobbies($value){
		$sql = 'SELECT * FROM patient_info WHERE hobbies = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM patient_info WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDob($value){
		$sql = 'DELETE FROM patient_info WHERE dob = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAddress($value){
		$sql = 'DELETE FROM patient_info WHERE address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPhone($value){
		$sql = 'DELETE FROM patient_info WHERE phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByGenderId($value){
		$sql = 'DELETE FROM patient_info WHERE genderId = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByOccupation($value){
		$sql = 'DELETE FROM patient_info WHERE occupation = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByReferred($value){
		$sql = 'DELETE FROM patient_info WHERE referred = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHobbies($value){
		$sql = 'DELETE FROM patient_info WHERE hobbies = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PatientInfoMySql 
	 */
	protected function readRow($row){
		$patientInfo = new PatientInfo();
		
		$patientInfo->patientInfoId = $row['patient_info_id'];
		$patientInfo->name = $row['name'];
		$patientInfo->dob = $row['dob'];
		$patientInfo->address = $row['address'];
		$patientInfo->phone = $row['phone'];
		$patientInfo->genderId = $row['genderId'];
		$patientInfo->occupation = $row['occupation'];
		$patientInfo->referred = $row['referred'];
		$patientInfo->hobbies = $row['hobbies'];

		return $patientInfo;
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
	 * @return PatientInfoMySql 
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