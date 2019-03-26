<?php
/**
 * Class that operate on table 'visual_antecedent'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualAntecedentEXT extends VisualAntecedentMySqlDAO{

    public function submitData($data = null,$pdo = null)
    {
        $refractionHisObj = new RefractionHistoryMySqlExtDAO();
        $validateData = $this->validateData($data);
        $result = true;
        
        if ($validateData['result']) {
            $data = $validateData['data'];
            
            if (isset($data->visualAntecedentId)) { //UPDATE
                $visualAntecedentId = $data->visualAntecedentId;
                if ($visualAntecedentId > 0) {
                    $existReasonConsultation = $refractionHisObj->loadPDO($pdo, $visualAntecedentId);
                    if ($existReasonConsultation->visualAntecedentId > 0) {
                        $update = $refractionHisObj->updatePDO($pdo, $data);
                        if(!$update){
                            $result = false;
                            $msg = "Something went wrong";
                        }
                    } else {
                        $result = false;
                        $msg = "Invalid Reason Consultation";
                    }
                }
            } else { //INSERT
                $visualAntecedentId = $refractionHisObj->insertPDO($pdo, $data);
                if(!$visualAntecedentId){
                    $result = false;
                    $msg = "Something went wrong";
                }
            }
            
        }else{
            $result = false;
            $errors = $validateData['errors'];
        }
        
        $response = new stdClass();
        $response['result'] = $result;
        if($result){
            $msg = "Refraction History Added";
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
            'ocularPathologies' => 'alpha_numeric',
            'ocularSurgeries' => 'alpha_numeric',
            'traumatism' => 'alpha_numeric',
            'medicationIntakeId' => 'integer',
            'medicationIntakeOther' => 'alpha_numeric',
            'familialRefractive' => 'alpha_numeric',
            'herecityDiseases' => 'alpha_numeric',
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