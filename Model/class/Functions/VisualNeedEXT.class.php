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
            $data = (object)$validateData['data'];

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
            
            
            if($result && $visualNeedId > 0){
                $patientWorkStationObj = new PatientWorkStationMySqlExtDAO();
                $patientAmbianceObj = new PatientAmbianceMySqlExtDAO();
                $deleteWorkStation = $patientWorkStationObj->deletePDO($pdo, "visual_need_id = ".$visualNeedId,PHP_INT_MAX);
                $deletePatientAmbiance = $patientAmbianceObj->deletePDO($pdo,  "visual_need_id = ".$visualNeedId,PHP_INT_MAX);

                foreach ($data->workStationId as $row){
                    $patientWorkStation = new PatientWorkStation();
                    $patientWorkStation->visualNeedId = $visualNeedId;
                    $patientWorkStation->workStationId = $row;
                    
                    $insertWorkStation = $patientWorkStationObj->insertPDO($pdo, $patientWorkStation);
                    if(!$insertWorkStation){
                        $result = false;
                        $errors = "Something went wrong";
                        break;
                    }
                }
                
                foreach ($data->ambianceId as $row){
                    $patientAmbiance = new PatientAmbiance();
                    $patientAmbiance->visualNeedId = $visualNeedId;
                    $patientAmbiance->ambianceId = $row;
                    
                    $insertAmbiance = $patientAmbianceObj->insertPDO($pdo, $patientAmbiance);
                    if(! $insertAmbiance){
                        $result = false;
                        $errors = "Something went wrong";
                        break;
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
            $msg = "Visual Needs Added";
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
        
        GUMP::add_filter("radio", function($value) {
            return $value=="on"||$value=="true"?1:0;
        });
        
        $data= $gump->sanitize($data);
        
        $gump->validation_rules(array(
            'isFar' => 'boolean',
            'isNear' => 'boolean',
            'isPartially' => 'boolean',
            'isFully' => 'boolean',
            'workDistance' => 'alpha_space',
            'workStationId' => 'integer',
            'lighting' => 'alpha_space',
            'isNeedColor' => 'boolean',
            'ambianceId' => 'integer',
            'ambianceOther' => 'alpha_space',
            'isTraumaRisk' => 'boolean',
            'description' => 'alpha_space',
            'extraProfessionActivity' => 'alpha_space',
        ));
        
        $gump->filter_rules(array(
            'taskDuration' => 'trim|sanitize_string',
            'workDistance' => 'trim|sanitize_string',
            'lighting' => 'trim|sanitize_string',
            'ambianceOther' => 'trim|sanitize_string',
            'description' => 'trim|sanitize_string',
            'extraProfessionActivity' => 'trim|sanitize_string',
            'isFar'=> 'radio',
            'isNear'=> 'radio',
            'isPartially'=> 'radio',
            'isFully'=> 'radio',
            'isNeedColor'=> 'radio',
            'isTraumaRisk'=> 'radio',
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