<?php
/**
 * Class that operate on table 'visual_need'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class VisualNeedEXT extends VisualNeedMySqlDAO{
    public function submitData($data = null,$pdo = null)
    {
        $visualNeedObj = new VisualNeedMySqlExtDAO();
        $validateData = $this->validateData($data);
        $result = true;
        
        if ($validateData['result']) {
            $data = $validateData['data'];
            
            if (isset($data->visualNeedId)) { //UPDATE
                $visualNeedId = $data->visualNeedId;
                if ($visualNeedId > 0) {
                    $existVisualNeed = $visualNeedObj->loadPDO($pdo, $visualNeedId);
                    if ($existVisualNeed->visualNeedId > 0) {
                        $update = $visualNeedObj->updatePDO($pdo, $data);
                        if(!$update){
                            $result = false;
                            $msg = "Something went wrong";
                        }
                    } else {
                        $result = false;
                        $msg = "Invalid Visual Need";
                    }
                }
            } else { //INSERT
                $visualNeedId = $visualNeedObj->insertPDO($pdo, $data);
                if(!$visualNeedId){
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
            $msg = "Visual Need Added";
            $response['message'] = $msg;
            $response['visualNeedId'] = $visualNeedId;
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
            'isFar' => 'boolean',
            'isNear' => 'boolean',
            'isPartially' => 'boolean',
            'isFully' => 'boolean',
            'taskDuration' => 'alpha_numeric',
            'workDistance' => 'alpha_numeric',
            'workStationId' => 'integer',
            'lighting' => 'alpha_numeric',
            'isNeedColor' => 'boolean',
            'ambianceId' => 'integer',
            'ambianceOther' => 'alpha_numeric',
            'isTraumaRisk' => 'boolean',
            'description' => 'alpha_numeric',
            'extraProfessionActivity' => 'alpha_numeric',
        ));
        
        $gump->filter_rules(array(
            'taskDuration' => 'trim|sanitize_string',
            'workDistance' => 'trim|sanitize_string',
            'lighting' => 'trim|sanitize_string',
            'ambianceOther' => 'trim|sanitize_string',
            'description' => 'trim|sanitize_string',
            'extraProfessionActivity' => 'trim|sanitize_string'
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