<?php
/**
 * Class that operate on table 'pupillary_reflexs'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PupillaryReflexsEXT extends PupillaryReflexsMySqlDAO{
    
    public function getAllRecords($data = array(),$strWhere = " 1 ",$order = " 1 ASC",$limit= PHP_INT_MAX,$offset = 0){
        $pdo = Database::getConnection();
        $Obj = new PupillaryReflexsMySqlExtDAO();
        $array = $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
        
        return $array;
    }
    
    public function submitData($data = null,$pdo = null)
    {
        $pupillaryReflexsObj = new PupillaryReflexsMySqlExtDAO();
        $validateData = $this->validateData($data);
        $result = true;
        
        if ($validateData['result']) {
            $data = (object)$validateData['data'];
            
            
            if(isset($data->preliminaryExaminationId)){
                
                $pupillaryReflexId = $pupillaryReflexsObj->insertPDO($pdo, $data);
                if(!$pupillaryReflexId){
                    $result = false;
                    $errors = "Something went wrong";
                }
            }else{
                $result = false;
                $errors= "Invalid Preliminary Examination";
            }
        }else{
            $result = false;
            $errors = $validateData['errors'];
        }
        
        $response = array();
        $response['result'] = $result;
        if($result){
            $msg = "Pupillary Reflex Added";
            $response['message'] = $msg;
            $response['pupillaryReflexId'] = $pupillaryReflexId;
        }else{
            $response['errors'] = $errors;
        }
        
        return $response;
    }
    
    private function validateData($data)
    {
        $data = (array)$data;
        $gump = new GUMP();
        
        $data= $gump->sanitize($data);
        
        $gump->validation_rules(array(
            'text' => 'alpha_space',
        ));
        
        $validated_data = $gump->run($data);
        
        if($validated_data){
            $returnArr['data'] = $validated_data;
            $returnArr['result'] = true;
        }else{
            $returnArr['result'] = false;
            $returnArr['errors'] = $gump->get_errors_array();
        }
        
        return $returnArr;
    }
    
}
?>