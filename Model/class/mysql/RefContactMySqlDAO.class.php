<?php
/**
 * Class that operate on table 'ref_contact'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefContactMySqlDAO implements RefContactDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return RefContactMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM ref_contact WHERE ref_eyeglasses_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM ref_contact';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM ref_contact ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param refContact primary key
 	 */
	public function delete($ref_eyeglasses_id){
		$sql = 'DELETE FROM ref_contact WHERE ref_eyeglasses_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ref_eyeglasses_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RefContactMySql refContact
 	 */
	public function insert($refContact){
		$sql = 'INSERT INTO ref_contact (refraction_history_id, sphere_od, sphere_os, cylinder_od, cylinder_os, axis_od, axis_os, wear_type_id, brand, dk, solution, reason_is_preferred) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($refContact->refractionHistoryId);
		$sqlQuery->set($refContact->sphereOd);
		$sqlQuery->set($refContact->sphereOs);
		$sqlQuery->set($refContact->cylinderOd);
		$sqlQuery->set($refContact->cylinderOs);
		$sqlQuery->set($refContact->axisOd);
		$sqlQuery->set($refContact->axisOs);
		$sqlQuery->setNumber($refContact->wearTypeId);
		$sqlQuery->set($refContact->brand);
		$sqlQuery->set($refContact->dk);
		$sqlQuery->set($refContact->solution);
		$sqlQuery->set($refContact->reasonIsPreferred);

		$id = $this->executeInsert($sqlQuery);	
		$refContact->refEyeglassesId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param RefContactMySql refContact
 	 */
	public function update($refContact){
		$sql = 'UPDATE ref_contact SET refraction_history_id = ?, sphere_od = ?, sphere_os = ?, cylinder_od = ?, cylinder_os = ?, axis_od = ?, axis_os = ?, wear_type_id = ?, brand = ?, dk = ?, solution = ?, reason_is_preferred = ? WHERE ref_eyeglasses_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($refContact->refractionHistoryId);
		$sqlQuery->set($refContact->sphereOd);
		$sqlQuery->set($refContact->sphereOs);
		$sqlQuery->set($refContact->cylinderOd);
		$sqlQuery->set($refContact->cylinderOs);
		$sqlQuery->set($refContact->axisOd);
		$sqlQuery->set($refContact->axisOs);
		$sqlQuery->setNumber($refContact->wearTypeId);
		$sqlQuery->set($refContact->brand);
		$sqlQuery->set($refContact->dk);
		$sqlQuery->set($refContact->solution);
		$sqlQuery->set($refContact->reasonIsPreferred);

		$sqlQuery->setNumber($refContact->refEyeglassesId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM ref_contact';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "ref_eyeglasses_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM ref_contact WHERE ref_eyeglasses_id = :ref_eyeglasses_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM ref_contact WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $ref_contact)
	{
	    try {
	        $data = $this->object_to_array($ref_contact);
	        return $pdo->insert('ref_contact', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $ref_contact, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($ref_contact);
	        return $pdo->update('ref_contact', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('ref_contact', $where, $limit);
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
	
	public function object_to_array($refContact)
	{
	    $data = array(
		'ref_eyeglasses_id'=>$refContact->refEyeglassesId,
		'refraction_history_id'=>$refContact->refractionHistoryId,
		'sphere_od'=>$refContact->sphereOd,
		'sphere_os'=>$refContact->sphereOs,
		'cylinder_od'=>$refContact->cylinderOd,
		'cylinder_os'=>$refContact->cylinderOs,
		'axis_od'=>$refContact->axisOd,
		'axis_os'=>$refContact->axisOs,
		'wear_type_id'=>$refContact->wearTypeId,
		'brand'=>$refContact->brand,
		'dk'=>$refContact->dk,
		'solution'=>$refContact->solution,
		'reason_is_preferred'=>$refContact->reasonIsPreferred
	    );
	    return $data;
	}
	
	

	public function queryByRefractionHistoryId($value){
		$sql = 'SELECT * FROM ref_contact WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySphereOd($value){
		$sql = 'SELECT * FROM ref_contact WHERE sphere_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySphereOs($value){
		$sql = 'SELECT * FROM ref_contact WHERE sphere_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCylinderOd($value){
		$sql = 'SELECT * FROM ref_contact WHERE cylinder_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCylinderOs($value){
		$sql = 'SELECT * FROM ref_contact WHERE cylinder_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAxisOd($value){
		$sql = 'SELECT * FROM ref_contact WHERE axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAxisOs($value){
		$sql = 'SELECT * FROM ref_contact WHERE axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByWearTypeId($value){
		$sql = 'SELECT * FROM ref_contact WHERE wear_type_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBrand($value){
		$sql = 'SELECT * FROM ref_contact WHERE brand = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDk($value){
		$sql = 'SELECT * FROM ref_contact WHERE dk = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySolution($value){
		$sql = 'SELECT * FROM ref_contact WHERE solution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByReasonIsPreferred($value){
		$sql = 'SELECT * FROM ref_contact WHERE reason_is_preferred = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByRefractionHistoryId($value){
		$sql = 'DELETE FROM ref_contact WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySphereOd($value){
		$sql = 'DELETE FROM ref_contact WHERE sphere_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySphereOs($value){
		$sql = 'DELETE FROM ref_contact WHERE sphere_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCylinderOd($value){
		$sql = 'DELETE FROM ref_contact WHERE cylinder_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCylinderOs($value){
		$sql = 'DELETE FROM ref_contact WHERE cylinder_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAxisOd($value){
		$sql = 'DELETE FROM ref_contact WHERE axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAxisOs($value){
		$sql = 'DELETE FROM ref_contact WHERE axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByWearTypeId($value){
		$sql = 'DELETE FROM ref_contact WHERE wear_type_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBrand($value){
		$sql = 'DELETE FROM ref_contact WHERE brand = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDk($value){
		$sql = 'DELETE FROM ref_contact WHERE dk = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySolution($value){
		$sql = 'DELETE FROM ref_contact WHERE solution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByReasonIsPreferred($value){
		$sql = 'DELETE FROM ref_contact WHERE reason_is_preferred = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return RefContactMySql 
	 */
	protected function readRow($row){
		$refContact = new RefContact();
		
		$refContact->refEyeglassesId = $row['ref_eyeglasses_id'];
		$refContact->refractionHistoryId = $row['refraction_history_id'];
		$refContact->sphereOd = $row['sphere_od'];
		$refContact->sphereOs = $row['sphere_os'];
		$refContact->cylinderOd = $row['cylinder_od'];
		$refContact->cylinderOs = $row['cylinder_os'];
		$refContact->axisOd = $row['axis_od'];
		$refContact->axisOs = $row['axis_os'];
		$refContact->wearTypeId = $row['wear_type_id'];
		$refContact->brand = $row['brand'];
		$refContact->dk = $row['dk'];
		$refContact->solution = $row['solution'];
		$refContact->reasonIsPreferred = $row['reason_is_preferred'];

		return $refContact;
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
	 * @return RefContactMySql 
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