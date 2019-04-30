<?php
/**
 * Class that operate on table 'reason_consultation'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ReasonConsultationMySqlDAO implements ReasonConsultationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ReasonConsultationMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM reason_consultation WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM reason_consultation';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM reason_consultation ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param reasonConsultation primary key
 	 */
	public function delete($reason_consultation_id){
		$sql = 'DELETE FROM reason_consultation WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($reason_consultation_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ReasonConsultationMySql reasonConsultation
 	 */
	public function insert($reasonConsultation){
		$sql = 'INSERT INTO reason_consultation (visit_id, date_appearance, characterstics_appearance, time_appearance, frequency_troubles, activity_context, associated_symptoms, chronicity, evolution, factors_relief, compensation_worm_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($reasonConsultation->visitId);
		$sqlQuery->set($reasonConsultation->dateAppearance);
		$sqlQuery->set($reasonConsultation->characteristicsAppearance);
		$sqlQuery->set($reasonConsultation->timeAppearance);
		$sqlQuery->set($reasonConsultation->frequencyTroubles);
		$sqlQuery->set($reasonConsultation->activityContext);
		$sqlQuery->set($reasonConsultation->associatedSymptoms);
		$sqlQuery->set($reasonConsultation->chronicity);
		$sqlQuery->set($reasonConsultation->evolution);
		$sqlQuery->set($reasonConsultation->factorsRelief);
		$sqlQuery->set($reasonConsultation->compensationWormType);

		$id = $this->executeInsert($sqlQuery);	
		$reasonConsultation->reasonConsultationId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ReasonConsultationMySql reasonConsultation
 	 */
	public function update($reasonConsultation){
		$sql = 'UPDATE reason_consultation SET visit_id = ?, date_appearance = ?, characterstics_appearance = ?, time_appearance = ?, frequency_troubles = ?, activity_context = ?, associated_symptoms = ?, chronicity = ?, evolution = ?, factors_relief = ?, compensation_worm_type = ? WHERE reason_consultation_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($reasonConsultation->visitId);
		$sqlQuery->set($reasonConsultation->dateAppearance);
		$sqlQuery->set($reasonConsultation->characteristicsAppearance);
		$sqlQuery->set($reasonConsultation->timeAppearance);
		$sqlQuery->set($reasonConsultation->frequencyTroubles);
		$sqlQuery->set($reasonConsultation->activityContext);
		$sqlQuery->set($reasonConsultation->associatedSymptoms);
		$sqlQuery->set($reasonConsultation->chronicity);
		$sqlQuery->set($reasonConsultation->evolution);
		$sqlQuery->set($reasonConsultation->factorsRelief);
		$sqlQuery->set($reasonConsultation->compensationWormType);

		$sqlQuery->setNumber($reasonConsultation->reasonConsultationId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM reason_consultation';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "reason_consultation_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM reason_consultation WHERE reason_consultation_id = :reason_consultation_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM reason_consultation WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $reason_consultation)
	{
	    try {
	        
	        $data = $this->object_to_array($reason_consultation);
	        return $pdo->insert('reason_consultation', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $reason_consultation, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($reason_consultation);
	        return $pdo->update('reason_consultation', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('reason_consultation', $where, $limit);
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
	
	public function object_to_array($reasonConsultation)
	{
	    $data = array(
		'reason_consultation_id'=>$reasonConsultation->reasonConsultationId,
		'visit_id'=>$reasonConsultation->visitId,
		'date_appearance'=>$reasonConsultation->dateAppearance,
		'characterstics_appearance'=>$reasonConsultation->characteristicsAppearance,
		'time_appearance'=>$reasonConsultation->timeAppearance,
		'frequency_troubles'=>$reasonConsultation->frequencyTroubles,
		'activity_context'=>$reasonConsultation->activityContext,
		'associated_symptoms'=>$reasonConsultation->associatedSymptoms,
		'chronicity'=>$reasonConsultation->chronicity,
		'evolution'=>$reasonConsultation->evolution,
		'factors_relief'=>$reasonConsultation->factorsRelief,
		'compensation_worm_type'=>$reasonConsultation->compensationWormType
	    );
	    return $data;
	}
	
	

	public function queryByVisitId($value){
		$sql = 'SELECT * FROM reason_consultation WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDateAppearance($value){
		$sql = 'SELECT * FROM reason_consultation WHERE date_appearance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCharactersticsAppearance($value){
		$sql = 'SELECT * FROM reason_consultation WHERE characterstics_appearance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTimeAppearance($value){
		$sql = 'SELECT * FROM reason_consultation WHERE time_appearance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFrequencyTroubles($value){
		$sql = 'SELECT * FROM reason_consultation WHERE frequency_troubles = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByActivityContext($value){
		$sql = 'SELECT * FROM reason_consultation WHERE activity_context = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAssociatedSymptoms($value){
		$sql = 'SELECT * FROM reason_consultation WHERE associated_symptoms = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByChronicity($value){
		$sql = 'SELECT * FROM reason_consultation WHERE chronicity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEvolution($value){
		$sql = 'SELECT * FROM reason_consultation WHERE evolution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFactorsRelief($value){
		$sql = 'SELECT * FROM reason_consultation WHERE factors_relief = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCompensationWormType($value){
		$sql = 'SELECT * FROM reason_consultation WHERE compensation_worm_type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByVisitId($value){
		$sql = 'DELETE FROM reason_consultation WHERE visit_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDateAppearance($value){
		$sql = 'DELETE FROM reason_consultation WHERE date_appearance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCharactersticsAppearance($value){
		$sql = 'DELETE FROM reason_consultation WHERE characterstics_appearance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTimeAppearance($value){
		$sql = 'DELETE FROM reason_consultation WHERE time_appearance = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFrequencyTroubles($value){
		$sql = 'DELETE FROM reason_consultation WHERE frequency_troubles = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByActivityContext($value){
		$sql = 'DELETE FROM reason_consultation WHERE activity_context = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAssociatedSymptoms($value){
		$sql = 'DELETE FROM reason_consultation WHERE associated_symptoms = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByChronicity($value){
		$sql = 'DELETE FROM reason_consultation WHERE chronicity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEvolution($value){
		$sql = 'DELETE FROM reason_consultation WHERE evolution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFactorsRelief($value){
		$sql = 'DELETE FROM reason_consultation WHERE factors_relief = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCompensationWormType($value){
		$sql = 'DELETE FROM reason_consultation WHERE compensation_worm_type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ReasonConsultationMySql 
	 */
	protected function readRow($row){
		$reasonConsultation = new ReasonConsultation();
		
		$reasonConsultation->reasonConsultationId = $row['reason_consultation_id'];
		$reasonConsultation->visitId = $row['visit_id'];
		$reasonConsultation->dateAppearance = $row['date_appearance'];
		$reasonConsultation->characteristicsAppearance = $row['characterstics_appearance'];
		$reasonConsultation->timeAppearance = $row['time_appearance'];
		$reasonConsultation->frequencyTroubles = $row['frequency_troubles'];
		$reasonConsultation->activityContext = $row['activity_context'];
		$reasonConsultation->associatedSymptoms = $row['associated_symptoms'];
		$reasonConsultation->chronicity = $row['chronicity'];
		$reasonConsultation->evolution = $row['evolution'];
		$reasonConsultation->factorsRelief = $row['factors_relief'];
		$reasonConsultation->compensationWormType = $row['compensation_worm_type'];
        
		return $reasonConsultation;
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
	 * @return ReasonConsultationMySql 
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