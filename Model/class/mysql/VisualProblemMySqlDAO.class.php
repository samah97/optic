<?php
/**
 * Class that operate on table 'visual_problem'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualProblemMySqlDAO implements VisualProblemDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return VisualProblemMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM visual_problem WHERE visual_problem_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM visual_problem';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM visual_problem ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param visualProblem primary key
 	 */
	public function delete($visual_problem_id){
		$sql = 'DELETE FROM visual_problem WHERE visual_problem_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($visual_problem_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param VisualProblemMySql visualProblem
 	 */
	public function insert($visualProblem){
		$sql = 'INSERT INTO visual_problem (title) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($visualProblem->title);

		$id = $this->executeInsert($sqlQuery);	
		$visualProblem->visualProblemId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param VisualProblemMySql visualProblem
 	 */
	public function update($visualProblem){
		$sql = 'UPDATE visual_problem SET title = ? WHERE visual_problem_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($visualProblem->title);

		$sqlQuery->setNumber($visualProblem->visualProblemId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM visual_problem';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "visual_problem_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM visual_problem WHERE visual_problem_id = :visual_problem_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM visual_problem WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $visual_problem)
	{
	    try {
	        $data = $this->object_to_array($visual_problem);
	        return $pdo->insert('visual_problem', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $visual_problem, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($visual_problem);
	        return $pdo->update('visual_problem', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('visual_problem', $where, $limit);
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
	
	public function object_to_array($visualProblem)
	{
	    $data = array(
		'visual_problem_id'=>$visualProblem->visualProblemId,
		'title'=>$visualProblem->title
	    );
	    return $data;
	}
	
	

	public function queryByTitle($value){
		$sql = 'SELECT * FROM visual_problem WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByTitle($value){
		$sql = 'DELETE FROM visual_problem WHERE title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return VisualProblemMySql 
	 */
	protected function readRow($row){
		$visualProblem = new VisualProblem();
		
		$visualProblem->visualProblemId = $row['visual_problem_id'];
		$visualProblem->title = $row['title'];

		return $visualProblem;
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
	 * @return VisualProblemMySql 
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