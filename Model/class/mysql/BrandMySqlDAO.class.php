<?php
/**
 * Class that operate on table 'brand'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-05-13 21:08
 */
class BrandMySqlDAO implements BrandDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return BrandMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM brand WHERE brand_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM brand';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM brand ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param brand primary key
 	 */
	public function delete($brand_id){
		$sql = 'DELETE FROM brand WHERE brand_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($brand_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param BrandMySql brand
 	 */
	public function insert($brand){
		$sql = 'INSERT INTO brand (name) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($brand->name);

		$id = $this->executeInsert($sqlQuery);	
		$brand->brandId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param BrandMySql brand
 	 */
	public function update($brand){
		$sql = 'UPDATE brand SET name = ? WHERE brand_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($brand->name);

		$sqlQuery->setNumber($brand->brandId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM brand';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function loadPDO($pdo, $id)
	{
	    $data = array(
	        "brand_id" => $id
	    );
	    try {
	        $loadPDO = $pdo->select('SELECT * FROM brand WHERE brand_id = :brand_id', $data);
	        return $this->readRow($loadPDO[0]);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function queryAllPDO($pdo, $strWhere = " ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
	{
	    try {
	        $array = $pdo->select("SELECT * FROM brand WHERE 1 $strWhere ORDER BY $order LIMIT $limit OFFSET $offset");
	        return $this->getListObj($array);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return null;
	    }
	}
	
	public function insertPDO($pdo, $brand)
	{
	    try {
	        $data = $this->object_to_array($brand);
	        return $pdo->insert('brand', $data);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return 0;
	    }
	}
	
	public function updatePDO($pdo, $brand, $where = 1)
	{
	    try {
	        $data = $this->object_to_array($brand);
	        return $pdo->update('brand', $data, $where);
	    } catch (\PDOException $e) {
	        echo $e->getMessage();
	        return false;
	    }
	}
	
	public function deletePDO($pdo, $where, $limit = 1)
	{
	    try {
	        return $pdo->delete('brand', $where, $limit);
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
	
	public function object_to_array($brand)
	{
	    $data = array(
		'brand_id'=>$brand->brandId,
		'name'=>$brand->name
	    );
	    return $data;
	}
	
	

	public function queryByName($value){
		$sql = 'SELECT * FROM brand WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM brand WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return BrandMySql 
	 */
	protected function readRow($row){
		$brand = new Brand();
		
		$brand->brandId = $row['brand_id'];
		$brand->name = $row['name'];

		return $brand;
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
	 * @return BrandMySql 
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