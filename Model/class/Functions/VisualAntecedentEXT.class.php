<?php
/**
 * Class that operate on table 'visual_antecedent'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualAntecedentEXT extends VisualAntecedentMySqlDAO{

    public function getDataByVisit($visitId){
        $pdo = Database::getConnection();
        
        $Obj = new VisualAntecedentMySqlExtDAO();
        $data = $Obj->getByVisit($pdo, $visitId);
        $id = $data->visualAntecedentId;
        
        $antecedentDiseaseObj = new AntecedentDiseaseMySqlExtDAO();
        
        $dataCondition = array("visualAntecedentId"=>$id);
        $strWhere = "visual_antecedent_id = :visualAntecedentId";
        
        $antecedentDisease = $antecedentDiseaseObj->getRecord($pdo, $dataCondition, $strWhere);
         $data->antecedentDisease = $antecedentDisease;
        
        return $data;
    }
    public function submitData($data = null,$pdo = null)
    {
        $visualAntecedentObj = new VisualAntecedentMySqlExtDAO();
        $validateData = $this->validateData($data);
        
        $result = true;
         
        if ($validateData['result']) {
            $data = (object)$validateData['data'];
            
            if (isset($data->visualAntecedentId)) { //UPDATE
                $visualAntecedentId = $data->visualAntecedentId;
                if ($visualAntecedentId > 0) {
                    $existReasonConsultation = $visualAntecedentObj->loadPDO($pdo, $visualAntecedentId);
                    if ($existReasonConsultation->visualAntecedentId > 0) {
                        $update = $visualAntecedentObj->updatePDO($pdo, $data);
                        if(!$update){
                            $result = false;
                            $errors= "Something went wrong";
                        }
                    } else {
                        $result = false;
                        $errors = "Invalid Reason Consultation";
                    }
                }
            } else { //INSERT
                $visualAntecedentId = $visualAntecedentObj->insertPDO($pdo, $data);
                if(!$visualAntecedentId){
                    $result = false;
                    $errors = "Something went wrong";
                }
            }
            
            if($result && $visualAntecedentId > 0){
                $antecedentDiseaseObj = new AntecedentDiseaseMySqlExtDAO();
                $deleteAll = $antecedentDiseaseObj->deletePDO($pdo, "visual_antecedent_id = ".$visualAntecedentId,PHP_INT_MAX);
                
                foreach ($data->disease as $row){
                    $antecedentDisease = new AntecedentDisease();
                    $antecedentDisease->visualAntecedentId = $visualAntecedentId;
                    $antecedentDisease->diseaseId = $row;
                    
                    $insertAntDisease = $antecedentDiseaseObj->insertPDO($pdo, $antecedentDisease);
                    if(! $insertAntDisease){
                        $result = false;
                        $errors = "Something went wrong";
                    }
                }
            }
            
        }else{
            $result = false;
            $errors = $validateData['errors'];
        }
        
        $response = array();
        $response['result'] = $result;
        if($result){
            $msg = "Visual Antecedent Added";
            $response['message'] = $msg;
            $response['visualAntecedentId'] = $visualAntecedentId;
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
            'ocularPathologies' => 'alpha_space',
            'ocularSurgeries' => 'alpha_space',
            'traumatism' => 'alpha_space',
            'medicationIntakeId' => 'integer',
            'medicationIntakeOther' => 'alpha_space',
            'familialRefractive' => 'alpha_space',
            'herecityDiseases' => 'alpha_space',
        ));
        
        $gump->filter_rules(array(
            'taskDuration' => 'trim|sanitize_string',
            'ocularPathologies' => 'trim|sanitize_string',
            'ocularSurgeries' => 'trim|sanitize_string',
            'traumatism' => 'trim|sanitize_string',
            'medicationIntakeId' => 'trim|sanitize_string',
            'medicationIntakeOther' => 'trim|sanitize_string',
            'familialRefractive' => 'trim|sanitize_string',
            'herecityDiseases' => 'trim|sanitize_string'
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