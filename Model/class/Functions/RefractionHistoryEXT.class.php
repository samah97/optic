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
        
        $refractionHisObj = new RefractionHistoryMySqlExtDAO();
        $validateData = $this->validateData($data);
        $result = true;
        
        if ($validateData['result']) {
            $data = $validateData['data'];
            
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
                        $msg = "Invalid Reason Consultation";
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
                if(in_array(TypeCorrection::Eyeglass, $data->typeCorrection)){
                    $refEyeglassObj = new RefEyeglassesEXT();   
                }
                if(in_array(TypeCorrection::Eyeglass, $data->typeCorrection)){
                    $refContactObj = new RefContactEXT();
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
            'dateOflastExam' => 'required|date,d/m/Y',
            'visitId'       => 'required|integer',
            'correctionTypeId'       => 'required|integer',
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