<?php
/**
 * Class that operate on table 'visual_antecedent'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualAntecedentMySqlDAO implements VisualAntecedentDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return VisualAntecedentMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM visual_antecedent WHERE visual_antecedent_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM visual_antecedent';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM visual_antecedent ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param visualAntecedent primary key
 	 */
	public function delete($visual_antecedent_id){
		$sql = 'DELETE FROM visual_antecedent WHERE visual_antecedent_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($visual_antecedent_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisualAntecedentMySql visualAntecedent
 	 */
	public function insert($visualAntecedent){
		$sql = 'INSERT INTO visual_antecedent (visit_id, ocular_pathologies, ocular_surgeries, traumatism, orthoptic_treatments, mediciation_intake_id, medication_intake_other, familial_refractive, herecity_diseases) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($visualAntecedent->visitId);
		$sqlQuery->set($visualAntecedent->ocularPathologies);
		$sqlQuery->set($visualAntecedent->ocularSurgeries);
		$sqlQuery->set($visualAntecedent->traumatism);
		$sqlQuery->set($visualAntecedent->orthopticTreatments);
		$sqlQuery->setNumber($visualAntecedent->mediciationIntakeId);
		$sqlQuery->set($visualAntecedent->medicationIntakeOther);
		$sqlQuery->set($visualAntecedent->familialRefractive);
		$sqlQuery->set($visualAntecedent->herecityDiseases);

		$id = $this->executeInsert($sqlQuery);	
		$visualAntecedent->visualAntecedentId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisualAntecedentMySql visualAntecedent
 	 */
	public function update($visualAntecedent){
		$sql = 'UPDATE visual_antecedent SET visit_id = ?, ocular_pathologies = ?, ocular_surgeries = ?, traumatism = ?, orthoptic_treatments = ?, mediciation_intake_id = ?, medication_intake_other = ?, familial_refractive = ?, herecity_diseases = ? WHERE visual_antecedent_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($visualAntecedent->visitId);
		$sqlQuery->set($visualAntecedent->ocularPathologies);
		$sqlQuery->set($visualAntecedent->ocularSurgeries);
		$sqlQuery->set($visualAntecedent->traumatism);
		$sqlQuery->set($visualAntecedent->orthopticTreatments);
		$sqlQuery->setNumber($visualAntecedent->mediciationIntakeId);
		$sqlQuery->set($visualAntecedent->medicationIntakeOther);
		$sqlQuery->set($visualAntecedent->familialRefractive);
		$sqlQuery->set($visualAntecedent->herecityDiseases);

		$sqlQuery->setNumber($visualAntecedent->visualAntecedentId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM visual_antecedent';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "visual_antecedent_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM visual_antecedent WHERE visual_antecedent_id = :visual_antecedent_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM visual_antecedent WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $visual_antecedent)
	{
	    try {
	        $data = $this->object_to_array($visual_antecedent);
	        return $pdo->insert('visual_antecedent', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $visual_antecedent, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($visual_antecedent);
	        return $pdo->update('visual_antecedent', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('visual_antecedent', $where, $limit);
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
	
	public function object_to_array($visualAntecedent)
	{
	    $data = array(
		'visual_antecedent_id'=>$visualAntecedent->visualAntecedentId,
		'visit_id'=>$visualAntecedent->visitId,
		'ocular_pathologies'=>$visualAntecedent->ocularPathologies,
		'ocular_surgeries'=>$visualAntecedent->ocularSurgeries,
		'traumatism'=>$visualAntecedent->traumatism,
		'orthoptic_treatments'=>$visualAntecedent->orthopticTreatments,
		'mediciation_intake_id'=>$visualAntecedent->mediciationIntakeId,
		'medication_intake_other'=>$visualAntecedent->medicationIntakeOther,
		'familial_refractive'=>$visualAntecedent->familialRefractive,
		'herecity_diseases'=>$visualAntecedent->herecityDiseases
	    );
	    return $data;
	}
	
	

	public function queryByVisitId($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByOcularPathologies($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE ocular_pathologies = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByOcularSurgeries($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE ocular_surgeries = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTraumatism($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE traumatism = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByOrthopticTreatments($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE orthoptic_treatments = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMediciationIntakeId($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE mediciation_intake_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMedicationIntakeOther($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE medication_intake_other = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFamilialRefractive($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE familial_refractive = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByHerecityDiseases($value){
		$sql = 'SELECT * FROM visual_antecedent WHERE herecity_diseases = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByVisitId($value){
		$sql = 'DELETE FROM visual_antecedent WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByOcularPathologies($value){
		$sql = 'DELETE FROM visual_antecedent WHERE ocular_pathologies = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByOcularSurgeries($value){
		$sql = 'DELETE FROM visual_antecedent WHERE ocular_surgeries = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTraumatism($value){
		$sql = 'DELETE FROM visual_antecedent WHERE traumatism = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByOrthopticTreatments($value){
		$sql = 'DELETE FROM visual_antecedent WHERE orthoptic_treatments = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMediciationIntakeId($value){
		$sql = 'DELETE FROM visual_antecedent WHERE mediciation_intake_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMedicationIntakeOther($value){
		$sql = 'DELETE FROM visual_antecedent WHERE medication_intake_other = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFamilialRefractive($value){
		$sql = 'DELETE FROM visual_antecedent WHERE familial_refractive = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByHerecityDiseases($value){
		$sql = 'DELETE FROM visual_antecedent WHERE herecity_diseases = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return VisualAntecedentMySql 
	 */
	protected function readRow($row){
		$visualAntecedent = new VisualAntecedent();
		
		$visualAntecedent->visualAntecedentId = $row['visual_antecedent_id'];
		$visualAntecedent->visitId = $row['visit_id'];
		$visualAntecedent->ocularPathologies = $row['ocular_pathologies'];
		$visualAntecedent->ocularSurgeries = $row['ocular_surgeries'];
		$visualAntecedent->traumatism = $row['traumatism'];
		$visualAntecedent->orthopticTreatments = $row['orthoptic_treatments'];
		$visualAntecedent->mediciationIntakeId = $row['mediciation_intake_id'];
		$visualAntecedent->medicationIntakeOther = $row['medication_intake_other'];
		$visualAntecedent->familialRefractive = $row['familial_refractive'];
		$visualAntecedent->herecityDiseases = $row['herecity_diseases'];

		return $visualAntecedent;
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
	 * @return VisualAntecedentMySql 
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