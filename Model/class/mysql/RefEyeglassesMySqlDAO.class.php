<?php
/**
 * Class that operate on table 'ref_eyeglasses'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefEyeglassesMySqlDAO implements RefEyeglassesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return RefEyeglassesMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE ref_eyeglasses_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM ref_eyeglasses';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM ref_eyeglasses ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param refEyeglasse primary key
 	 */
	public function delete($ref_eyeglasses_id){
		$sql = 'DELETE FROM ref_eyeglasses WHERE ref_eyeglasses_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($ref_eyeglasses_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param RefEyeglassesMySql refEyeglasse
 	 */
	public function insert($refEyeglasse){
		$sql = 'INSERT INTO ref_eyeglasses (refraction_history_id, sphere_od, sphere_os, cylinder_od, cylinder_os, axis_od, axis_os, addition, pd_od, pd_os, prism_od, prism_os, base_od, base_os) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($refEyeglasse->refractionHistoryId);
		$sqlQuery->set($refEyeglasse->sphereOd);
		$sqlQuery->set($refEyeglasse->sphereOs);
		$sqlQuery->set($refEyeglasse->cylinderOd);
		$sqlQuery->set($refEyeglasse->cylinderOs);
		$sqlQuery->set($refEyeglasse->axisOd);
		$sqlQuery->set($refEyeglasse->axisOs);
		$sqlQuery->set($refEyeglasse->addition);
		$sqlQuery->set($refEyeglasse->pdOd);
		$sqlQuery->set($refEyeglasse->pdOs);
		$sqlQuery->set($refEyeglasse->prismOd);
		$sqlQuery->set($refEyeglasse->prismOs);
		$sqlQuery->set($refEyeglasse->baseOd);
		$sqlQuery->set($refEyeglasse->baseOs);

		$id = $this->executeInsert($sqlQuery);	
		$refEyeglasse->refEyeglassesId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param RefEyeglassesMySql refEyeglasse
 	 */
	public function update($refEyeglasse){
		$sql = 'UPDATE ref_eyeglasses SET refraction_history_id = ?, sphere_od = ?, sphere_os = ?, cylinder_od = ?, cylinder_os = ?, axis_od = ?, axis_os = ?, addition = ?, pd_od = ?, pd_os = ?, prism_od = ?, prism_os = ?, base_od = ?, base_os = ? WHERE ref_eyeglasses_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($refEyeglasse->refractionHistoryId);
		$sqlQuery->set($refEyeglasse->sphereOd);
		$sqlQuery->set($refEyeglasse->sphereOs);
		$sqlQuery->set($refEyeglasse->cylinderOd);
		$sqlQuery->set($refEyeglasse->cylinderOs);
		$sqlQuery->set($refEyeglasse->axisOd);
		$sqlQuery->set($refEyeglasse->axisOs);
		$sqlQuery->set($refEyeglasse->addition);
		$sqlQuery->set($refEyeglasse->pdOd);
		$sqlQuery->set($refEyeglasse->pdOs);
		$sqlQuery->set($refEyeglasse->prismOd);
		$sqlQuery->set($refEyeglasse->prismOs);
		$sqlQuery->set($refEyeglasse->baseOd);
		$sqlQuery->set($refEyeglasse->baseOs);

		$sqlQuery->setNumber($refEyeglasse->refEyeglassesId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM ref_eyeglasses';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "ref_eyeglasses_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM ref_eyeglasses WHERE ref_eyeglasses_id = :ref_eyeglasses_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM ref_eyeglasses WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $ref_eyeglasses)
	{
	    try {
	        $data = $this->object_to_array($ref_eyeglasses);
	        return $pdo->insert('ref_eyeglasses', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $ref_eyeglasses, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($ref_eyeglasses);
	        return $pdo->update('ref_eyeglasses', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('ref_eyeglasses', $where, $limit);
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
	
	public function object_to_array($refEyeglasse)
	{
	    $data = array(
		'ref_eyeglasses_id'=>$refEyeglasse->refEyeglassesId,
		'refraction_history_id'=>$refEyeglasse->refractionHistoryId,
		'sphere_od'=>$refEyeglasse->sphereOd,
		'sphere_os'=>$refEyeglasse->sphereOs,
		'cylinder_od'=>$refEyeglasse->cylinderOd,
		'cylinder_os'=>$refEyeglasse->cylinderOs,
		'axis_od'=>$refEyeglasse->axisOd,
		'axis_os'=>$refEyeglasse->axisOs,
		'addition'=>$refEyeglasse->addition,
		'pd_od'=>$refEyeglasse->pdOd,
		'pd_os'=>$refEyeglasse->pdOs,
		'prism_od'=>$refEyeglasse->prismOd,
		'prism_os'=>$refEyeglasse->prismOs,
		'base_od'=>$refEyeglasse->baseOd,
		'base_os'=>$refEyeglasse->baseOs
	    );
	    return $data;
	}
	
	

	public function queryByRefractionHistoryId($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySphereOd($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE sphere_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySphereOs($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE sphere_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCylinderOd($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE cylinder_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCylinderOs($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE cylinder_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAxisOd($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAxisOs($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAddition($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE addition = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPdOd($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE pd_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPdOs($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE pd_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPrismOd($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE prism_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPrismOs($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE prism_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBaseOd($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE base_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBaseOs($value){
		$sql = 'SELECT * FROM ref_eyeglasses WHERE base_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByRefractionHistoryId($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE refraction_history_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySphereOd($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE sphere_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySphereOs($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE sphere_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCylinderOd($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE cylinder_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCylinderOs($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE cylinder_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAxisOd($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE axis_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAxisOs($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE axis_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAddition($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE addition = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPdOd($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE pd_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPdOs($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE pd_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPrismOd($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE prism_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPrismOs($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE prism_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBaseOd($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE base_od = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBaseOs($value){
		$sql = 'DELETE FROM ref_eyeglasses WHERE base_os = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return RefEyeglassesMySql 
	 */
	protected function readRow($row){
		$refEyeglasse = new RefEyeglasse();
		
		$refEyeglasse->refEyeglassesId = $row['ref_eyeglasses_id'];
		$refEyeglasse->refractionHistoryId = $row['refraction_history_id'];
		$refEyeglasse->sphereOd = $row['sphere_od'];
		$refEyeglasse->sphereOs = $row['sphere_os'];
		$refEyeglasse->cylinderOd = $row['cylinder_od'];
		$refEyeglasse->cylinderOs = $row['cylinder_os'];
		$refEyeglasse->axisOd = $row['axis_od'];
		$refEyeglasse->axisOs = $row['axis_os'];
		$refEyeglasse->addition = $row['addition'];
		$refEyeglasse->pdOd = $row['pd_od'];
		$refEyeglasse->pdOs = $row['pd_os'];
		$refEyeglasse->prismOd = $row['prism_od'];
		$refEyeglasse->prismOs = $row['prism_os'];
		$refEyeglasse->baseOd = $row['base_od'];
		$refEyeglasse->baseOs = $row['base_os'];

		return $refEyeglasse;
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
	 * @return RefEyeglassesMySql 
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