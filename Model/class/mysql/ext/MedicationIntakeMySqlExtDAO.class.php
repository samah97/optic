<?php
/**
 * Class that operate on table 'medication_intake'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-04 22:53
 */
class MedicationIntakeMySqlExtDAO extends MedicationIntakeMySqlDAO{
    public function getAllRecords($pdo, $data = array(), $strWhere = " 1 ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
    {
        if (! is_array($data)) {
            $data = array();
        }
        
        $query = " SELECT * FROM medication_intake
        WHERE $strWhere ORDER BY $order LIMIT $limit OFFSET $offset";
        
        try {
            $array = $pdo->select($query, $data);
            return $this->getListObj($array);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
	
}
?>