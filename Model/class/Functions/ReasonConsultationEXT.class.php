<?php
/**
 * Class that operate on table 'reason_consultation'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class ReasonConsultationEXT extends ReasonConsultationMySqlDAO{

    public function submitData($data = null,$pdo = null)
    {
        $reasonConsultationObj = new ReasonConsultationMySqlExtDAO();
        
        $validateData = $this->validateData($data);
        $result = true;
        if ($validateData->result) {
            
            if (isset($data->reasonConsultationId)) { //UPDATE
                $reasonConsultationId = $data->reasonConsultationId;
                if ($reasonConsultationId > 0) {
                    $existReasonConsultation = $reasonConsultationObj->loadPDO($pdo, $reasonConsultationId);
                    if ($existReasonConsultation->reasonConsultationId > 0) {
                        $update = $reasonConsultationObj->updatePDO($pdo, $data);
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
                $reasonConsultationId = $reasonConsultationObj->insertPDO($pdo, $data);
                if(!$reasonConsultationId){
                    $result = false;
                    $errors = "Something went wrong";
                }
            }
            
            if($result && $reasonConsultationId > 0){
                $visualProblems = $data->visualProblems;
                $functionalSigns =  $data->functionalSigns;
                $visualProblemsObj = new VisualProblemMySqlExtDAO();
                $consulationVpObj = new ConsultationVpMySqlExtDAO();
                $consulationFsObj = new ConsulationFsMySqlExtDAO();
                
                $deleteVP = $consulationVpObj->deletePDO($pdo, 'reason_consultation_id = '.$reasonConsultationId,PHP_INT_MAX);
                $deleteFS = $consulationVpObj->deletePDO($pdo, 'reason_consultation_id = '.$reasonConsultationId,PHP_INT_MAX);
                
                
                foreach($visualProblems as $val){
                    $consulationVp = new ConsultationVp();
                    $consulationVp->reasonConsultationId = $reasonConsultationId;
                    $consulationVp->visualProblemId = $val;
                    
                    $consulationVpId = $consulationVpObj->insertPDO($pdo, $consulationVp);
                    if(! $consulationVpId){
                        $result = false;
                        $msg = "Something went wrong";
                        break;
                    }
                }
                
                foreach($functionalSigns as $val){
                    $consultationFs = new ConsulationF();
                    $consultationFs->reasonConsultationId = $reasonConsultationId;
                    $consultationFs->functionSignId = $val;
                    
                    $consultationFsId = $consulationFsObj->insertPDO($pdo, $consultationFs);
                    if(! $consultationFsId){
                        $result = false;
                        $msg = "Something went wrong";
                        break;
                    }
                }
            }else{
                $result = false;
                $errors = "Something went wrong";
            }
            
        }else{
            $result = false;
            $errors = $validateData->errors;
        }
        
        $response['result'] = $result;
        if($result){
            $msg = "Reason Consultation Added";
            $response['message'] = $msg;
            $response['reasonConsultationId'] = $reasonConsultationId;
        }else{
            $response['errors'] = $errors;
        }
        
        return $response;
    }
    
    private function validateData($data)
    {
        $validation = new Validation();
        $validation->name('Date of Appearance')
        ->value($data->dateAppearance)
        ->pattern('date_dmy')
        ->required();
        $validation->name('Characteristics of Appearance')
        ->value($data->characteristicsAppearance)
        ->pattern('words');
        $validation->name('Time of Appearance')
        ->value($data->timeAppearance);
        
        $validation->name('Frequency of Troubles')
        ->value($data->frequencyTroubles)
        ->pattern('words');

        $validation->name('Activity Context')
        ->value($data->activityContext)
        ->pattern('words');

        $validation->name('Associated Symptoms')
        ->value($data->associatedSymptoms)
        ->pattern('words');
        
        $validation->name('Chronicity')
        ->value($data->chronicity)
        ->pattern('words');
        
        $validation->name('Evolution')
        ->value($data->evolution)
        ->pattern('words');
        
        $validation->name('Factors Relief')
        ->value($data->factorsRelief)
        ->pattern('words');
        
        $validation->name('Compensation Worm Type')
        ->value($data->compensationWormType)
        ->pattern('words');
        
        $returnObj = new stdClass();
        if ($validation->isSuccess()) {
            $returnObj->result = true;
        } else {
            $returnObj->result = false;
            $returnObj->errors = $validation->getErrors();
        }
        
        return $returnObj;
    }
    
}
?>