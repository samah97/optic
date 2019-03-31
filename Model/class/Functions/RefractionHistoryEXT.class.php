<?php
/**
 * Class that operate on table 'refraction_history'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefractionHistoryEXT extends RefractionHistoryMySqlDAO{
    
    public function submitData($data = null,$pdo = null)
    {
        $correctionTypeIdArr = $data->correctionTypeId;
        $correctionTypeIdArr[] = 1;
        $data->correctionTypeId = json_encode($data->correctionTypeId);
        
        $refractionHisObj = new RefractionHistoryMySqlExtDAO();
        $validateData = $this->validateData($data);
        
        $result = true;
        
        if ($validateData['result']) {
            $data = (object)$validateData['data'];
            
            if (isset($data->refractionHistoryId)) { //UPDATE
                $refractionHistoryId = $data->refractionHistoryId;
                if ($refractionHistoryId > 0) {
                    $existReasonConsultation = $refractionHisObj->loadPDO($pdo, $refractionHistoryId);
                    if ($existReasonConsultation->refractionHistoryId > 0) {
                        $update = $refractionHisObj->updatePDO($pdo, $data);
                        if(!$update){
                            $result = false;
                            $msg = "Something went wrong";
                        }
                    } else {
                        $result = false;
                        $msg = "Invalid Refraction History";
                    }
                }
            } else { //INSERT
                $refractionHistoryId = $refractionHisObj->insertPDO($pdo, $data);
                
                if(!$refractionHistoryId){
                    $result = false;
                    $msg = "Something went wrong";
                }
            }
            
            if($result && $refractionHistoryId > 0){
                
                $refEyeglassObj = new RefEyeglassesEXT();
                $refContactObj = new RefContactEXT();
                
                $deleteWhere = "refraction_history_id = ".$refractionHistoryId;
                
                $deleteEyeglass = $refEyeglassObj->deletePDO($pdo, $deleteWhere);
                $deleteContact = $refContactObj->deletePDO($pdo, $deleteWhere);
                
                if(in_array(TypeCorrection::Eyeglass, $correctionTypeIdArr)){
                    $refEyeglassData = $data->refEyeglasses;
                    $refEyeglassData->refractionHistoryId = $refractionHistoryId;
                    $refEyeglass = $refEyeglassObj->submitData($refEyeglassData,$pdo);
                    if(!$refEyeglass['result']){
                        $result = false;
                        $errors = $refEyeglass['errors'];
                    }
                }
                if(in_array(TypeCorrection::Contact_Lenses, $correctionTypeIdArr)){
                    $refContactData = $data->refContact;
                    $refContactData->refractionHistoryId = $refractionHistoryId;
                    $refContact = $refContactObj->submitData($refContactData,$pdo);
                    if(!$refContact['result']){
                        $result = false;
                        $errors = $refContact['errors'];
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
            $msg = "Refraction History Added";
            $response['message'] = $msg;
            $response['refractionHistoryId'] = $refractionHistoryId;
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
            'dateOflastExam' => 'required|date,Y-m-d',
            'visitId'       => 'required|integer',
            'correctionTypeId'       => 'required',
            'satisfaction'      => 'alpha_space',
            'wearingFrequence'      => 'alpha_space',
            'reasonCorrection'      => 'alpha_space',
            'examDetails' => 'alpha_space'
        ));
        
        $gump->filter_rules(array(
            'satisfaction' => 'trim|sanitize_string',
            'wearingFrequence' => 'trim|sanitize_string',
            'reasonCorrection'   => 'trim|sanitize_string',
            'examDetails'	   => 'trim|sanitize_string'
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