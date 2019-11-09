<?php
class Database extends PDO
{
    
    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
    }
    
    public static function getConnection(){
        try{
        return new Database("mysql", \ConnectionProperty::getHost(), \ConnectionProperty::getDatabase(), \ConnectionProperty::getUser(), \ConnectionProperty::getPassword());
        }catch(\PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {  
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        if(!$sth->execute()){
            $this->handleError();
            //print_r($sth->errorInfo());
        }
        else{
            return $sth->fetchAll($fetchMode);
        }
    }
    
    public function insert($table, $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        
        if(!$sth->execute()){
            $this->handleError();
            //print_r($sth->errorInfo());
            return 0;
        }
        return $this->lastInsertId();
    }
    
    public function update($table, $data, $where)
    {
        ksort($data);
        
        $fieldDetails = NULL;
        foreach($data as $key=> $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        
        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        if(!$sth->execute()){
            $this->handleError();
            //print_r($sth->errorInfo());
            return false;
        }else{
            return true;
        }
       
    }
    
    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }
    
    /* count rows*/
    public function rowsCount($table){
        $sth = $this->prepare("SELECT * FROM ".$table);
        $sth->execute();
        return $sth -> rowCount();
    }
    
    /* error check */
    private function handleError()
    {
        if ($this->errorCode() != '00000')
        {
            if ($this->_errorLog == true)
                //Log::write($this->_errorLog, "Error: " . implode(',', $this->errorInfo()));
                echo json_encode($this->errorInfo());
                throw new Exception("Error: " . implode(',', $this->errorInfo()));
        }
    }
    
}
