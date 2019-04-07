<?php
/**
 * Class that operate on table 'visit'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-23 16:00
 */
class VisitEXT extends VisitMySqlDAO{

    public function getAllRecords($columns= " * ",$data = array(),$strWhere = " 1 ",$order = " 1 DESC",$limit = PHP_INT_MAX,$offset = 0){
        $pdo = Database::getConnection();
        $Obj = new VisitMySqlExtDAO();
        return $Obj->getAllRecords($pdo,$columns,$data,$strWhere,$order,$limit,$offset);
    }
    
    public function getVisit($id){
        $pdo = Database::getConnection();
        return $this->loadPDO($pdo, $id);
    }
    
    public function submitData($data = null,$pdo = null)
    {
        $visitObj = new VisitMySqlExtDAO();
        $validateData = $this->validateData($data);
        
        $result = true;
        if ($validateData['result']) {
            
            $data = (object)$validateData['data'];
            
            if (isset($data->visitId)) { //UPDATE
                $visitId = $data->visitId;
                if ($visitId > 0) {
                    $existVisit = $visitObj->loadPDO($pdo, $visitId);
                    //$existPatient = $patientInfoObj->loadPDO($pdo, $patientId);
                    if ($existVisit->visitId > 0) {
                        $update = $visitObj->updatePDO($pdo, $visitId);
                        if(!$update){
                            $result = false;
                            $msg = "Something went wrong";
                        }
                    } else {
                        $result = false;
                        $msg = "Invalid Visit";
                    }
                }
            } else { //INSERT
                
                $checkFirstVisit = $visitObj->getCountVisit($pdo,$data->patientInfoId);
                
                if($checkFirstVisit->count == 0){
                    $data->isFirstVisit = true;
                }
                $visitId = $visitObj->insertPDO($pdo, $data);
                if(!$visitId){
                    $result = false;
                    $msg = "Something went wrong";
                }
            }
        }else{
            $result = false;
            $msg = $validateData->get_errors_array();
        }
        
        $response['result'] = $result;
        if($result){
            $response['visitId'] = $visitId;
        }else{
            $response['errors'] = $msg;
        }
        
        return $response;
    }
    
    private function validateData($data){
        $data = (array)$data;
        $gump = new GUMP();
        
        $data= $gump->sanitize($data);
        
        $gump->validation_rules(array(
            'deduction'       => 'alpha_space',
            'patientInfoId'      => 'required|integer',
        ));
        
        $gump->filter_rules(array(
            'deduction' => 'trim|sanitize_string',
        ));
        
        $validated_data = $gump->run($data);
        
        $returnObj = array();
        if($validated_data){
            $returnObj['data'] = $validated_data;
            $returnObj['result'] = true;
        }else{
            $returnObj['result'] = false;
            $returnObj['errors'] = $gump->get_errors_array();
        }
        
        return $returnObj;
    }
}
?>