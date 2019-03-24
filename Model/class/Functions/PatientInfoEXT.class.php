<?php

/**
 * Class that operate on table 'patient_info'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class PatientInfoEXT extends PatientInfoMySqlDAO
{

    public function submitAllData()
    {
        
        //print_r(openssl_get_cipher_methods());die();
        $test = Common::cryptoo('samah', 'e');
        $test2 = Common::cryptoo($test, 'd');

        
        $post = file_get_contents('php://input');
        $post = json_decode($post);
        
        if(isset($post->visitId)) {
            $visitId = Common::cryptoo($post->visitId, 'd');
        }
        
        $visitData = $post->visitData;
        $patientData = $post->patientData;
        $consultationData = $post->consultationData;
        $refractionData = $post->refractionData;
        $visualNeedsData = $post->visualNeedsData;
        $visualAntecedentsData = $post->visualAntecedentsData;
        $examinationData = $post->examinationData;

        $pdo = Database::getConnection();
        $pdo->beginTransaction();
        
        //Insert Patient Data
        $patientDataResponse = $this->submitPatientData($patientData,$pdo);
        //End Patient Data
        
        $result = $patientDataResponse['result'];
        $patientId = $patientDataResponse['patientId'];
        if ($result && $patientId > 0) {
            
            $visitData->patientInfoId = $patientId;
            $visitData->datetime = date('Y-m-d H:i:s');
            
            //Insert Visit Data
            $visitObj = new VisitEXT();
            $visitResponse = $visitObj->submitData($visitData,$pdo);
            //End Visit Data
            
            if($visitResponse['result']){
                $consultationData->visitId = $visitResponse['visitId'];
                
                //Insert Consultation Data
                $reasonConsultationObj = new ReasonConsultationEXT();
                $reasonConsultationResponse = $reasonConsultationObj->submitData($consultationData,$pdo);
                //End Consultation Data
                
                if($reasonConsultationResponse['result']){
                    $refractionHistoryObj = new RefractionHistoryEXT();
                    $refractionHistoryResponse =$refractionHistoryObj->submitData($refractionData,$pdo);
                    
                    if($refractionHistoryResponse['result']){
                        
                    }
                }
            }else{
                $result = false;
                $errors = $visitResponse['errors'];
            }

        }
    }

    public function submitPatientData($patientData = null,$pdo = null)
    {
        $patientInfoObj = new PatientInfoMySqlExtDAO();
        $validateData = $this->validateData($patientData);
        
        $result = true;
        if ($validateData['result']) {    
            $patientData = $validateData['data'];
            
            if (isset($patientData->patientId)) { //UPDATE
                $patientId = $patientData->patientId;
                if ($patientId > 0) {
                    $existPatient = $patientInfoObj->loadPDO($pdo, $patientId);
                    if ($existPatient->patientId > 0) {
                        
                        $update = $patientInfoObj->updatePDO($pdo, $patientData);
                        if(!$update){
                            $result = false;
                            $msg = "Something went wrong";
                        }
                    } else {
                        $result = false;
                        $msg = "Invalid Patient";
                    }
                }
            } else { //INSERT
                
                $patientId = $patientInfoObj->insertPDO($pdo, $patientData);
                if(!$patientId){
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
            $response['patientId'] = $patientId;
        }else{
            $response['errors'] = $msg;
        }
        
        return $response;
    }

    private function validateData($data){
        $data = (array)$data;
        $gump = new GUMP();
        
        $data= $gump->sanitize($data);

        //'phone'       => 'required|regex,/[+]*(961(3|5|1|7|70|71|81)|(03|05|01|07|70|71|81))\d{6}/',
        
        $gump->validation_rules(array(
            'name'    => 'required|valid_name',
            'date'    => 'required|date,d/m/Y',
            'address'       => 'required|alpha_space',
            'phone'       => 'required|regex,/[+]*[0-9]{8}/',
            'genderId'      => 'required|integer|min_numeric,1|max_numeric,2',
            'referred' => 'required|alpha_space'
        ));
        
        $gump->filter_rules(array(
            'name' => 'trim|sanitize_string',
            'address' => 'trim|sanitize_string',
            'genderId'   => 'trim',
            'referred'	   => 'noise_words'
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