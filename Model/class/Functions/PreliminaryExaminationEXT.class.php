<?php
/**
 * Class that operate on table 'preliminary_examination'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class PreliminaryExaminationEXT extends PreliminaryExaminationMySqlDAO{

    public function submitData($data = null,$pdo = null)
    {
        
        $preliminaryObj = new PreliminaryExaminationMySqlExtDAO();
        $validateData = $this->validateData($data);
        print_r($data);
        $result = true;
        
        if ($validateData['result']) {
            $data = (object)$validateData['data'];
            
            if (isset($data->preliminaryExaminationId)) { //UPDATE
                $preliminaryExaminationId = $data->preliminaryExaminationId;
                if ($preliminaryExaminationId > 0) {
                    $existReasonConsultation = $preliminaryObj->loadPDO($pdo, $preliminaryExaminationId);
                    if ($existReasonConsultation->preliminaryExaminationId > 0) {
                        $update = $preliminaryObj->updatePDO($pdo, $data);
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
                $preliminaryExaminationId = $preliminaryObj->insertPDO($pdo, $data);
                if(!$preliminaryExaminationId){
                    $result = false;
                    $msg = "Something went wrong";
                }
            }
            
            if($result && $preliminaryExaminationId> 0){
                $keratomeryData = $data->keratomeryData;
                $keratomeryData->preliminaryExaminationId = $preliminaryExaminationId;

                $keratomeryObj = new KeratomeryEXT();
                $keratomery = $keratomeryObj->submitData($keratomeryData,$pdo);
                
                if($keratomery['result']){
                    $pupillaryReflexsData = $data->pupillaryReflexsData;
                    $pupillaryReflexsObj = new PupillaryReflexsEXT();
                    
                    //Delete Existing
                    $deleteAll = $pupillaryReflexsObj->deletePDO($pdo, "preliminary_examination_id = ".$preliminaryExaminationId,PHP_INT_MAX);
                    
                    foreach($pupillaryReflexsData as $rowData){
                        $rowData->preliminaryExaminationId = $preliminaryExaminationId;
                        $pupillaryReflexResponse = $pupillaryReflexsObj->submitData($rowData,$pdo);
                        if(! $pupillaryReflexResponse['result']){
                            $result = false;
                            $errors = $pupillaryReflexResponse['errors'];
                            break;
                        }
                    }
                    
                    
                    if($result){
                        
                        $preOcularMotilityData = $data->preOcularMotilityData;
                        $preOcularMotilityObj = new PreOcularMotilityEXT();
                        
                        //Delete Existing
                        $deleteAll = $preOcularMotilityObj->deletePDO($pdo, "preliminary_examination_id = ".$preliminaryExaminationId,PHP_INT_MAX);
                        foreach($preOcularMotilityData as $rowData){
                            $preOcularMotility = new PreOcularMotility();
                            $preOcularMotility->preliminaryExaminationId = $preliminaryExaminationId;
                            $preOcularMotility->ocularMotilityId = $rowData;
                            $preOcularMotilityId = $preOcularMotilityObj->insertPDO($pdo, $preOcularMotility);
                        }
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
            $msg = "Preliminary Examination Added";
            $response['message'] = $msg;
            $response['preliminaryExaminationId'] = $preliminaryExaminationId;
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
            'harmonDistanceId' => 'integer',
            'convergenceBrisDistance' => 'alpha_space',
            'convegenceRecoverement' => 'alpha_space',
            'convergenceXy' => 'alpha_space',
            'stereoWirtTest' => 'alpha_space',
            'ocularMotility' => 'alpha_space',
        ));
        
        $gump->filter_rules(array(
            'convergenceBrisDistance' => 'trim|sanitize_string',
            'convegenceRecoverement' => 'trim|sanitize_string',
            'convergenceXy' => 'trim|sanitize_string',
            'stereoWirtTest' => 'trim|sanitize_string',
            'ocularMotility' => 'trim|sanitize_string',
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