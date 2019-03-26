<?php

/**
 * Class that operate on table 'control'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ControlMySqlExtDAO extends ControlMySqlDAO
{

    public function getAllRecords($pdo, $data = array(), $strWhere = " 1 ", $order = " 1 ASC", $limit = PHP_INT_MAX, $offset = 0)
    {
        if (! is_array($data)) {
            $data = array();
        }
        
        $query = " SELECT * FROM control
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