<?php
/**
 * Class that operate on table 'patient_info'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class PatientInfoEXT extends PatientInfoMySqlDAO{
    
    public function submitAllData(){
        
        $post = file_get_contents('php://input');
        $post = json_decode($post);
        
        $patientData = $post->patientData;
        $consultationData = $post->consultationData;
        $refractionData = $post->refractionData;
        $visualNeedsData = $post->visualNeedsData;
        $visualAntecedentsData = $post->visualAntecedentsData;
        $examinationData = $post->examinationData;
        
        $patientId = $post->patientId;
        $patientInfoObj = new PatientInfoMySqlExtDAO();
        
        $pdo = Database::getConnection();
        $pdo->beginTransaction();
        
        $status = true;
        if(isset($post->patientId)){
        if( is_integer($patientId) > 0){ //
            $patientInfo = $patientInfoObj->loadPDO($pdo, $patientId);
            if(count($patientInfo) <= 0){
                $status = false;
                $message = "Invalid Patient";
            }
        }
        }else{
            $patientResult = $this->submitPatientData($patientData);
            $status = $patientResult->status;
            $patientId = $patientResult->patientId;
        }
        
        if($status && $patientId > 0){
            
            //$consultationObj =  
        }
    }
	
    
    public function submitPatientData(){
        
    }
}
?>