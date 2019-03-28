<?php
/**
 * Class that operate on table 'keratomery'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-03-16 13:07
 */
class KeratomeryEXT extends KeratomeryMySqlDAO{

    public function submitData($data = null,$pdo = null)
    {
        $validateData = $this->validateData($data);
        $result = true;
        
        if ($validateData['result']) {
            $data = (object)$validateData['data'];
            
            $keratomeryObj = new KeratomeryEXT();
            if(isset($data->preliminaryExaminationId)){
                //Delete Existing
                $deleteAll = $keratomeryObj->deletePDO($pdo, "preliminary_examination_id = ".$data->preliminaryExaminationId,PHP_INT_MAX);
                
                $keratomeryId = $keratomeryObj->insertPDO($pdo, $data);
                if(!$keratomeryId){
                    $result = false;
                    $errors = "Something went wrong";
                }
            }
        }else{
            $result = false;
            $errors = $validateData['errors'];
        }
        
        $response = array();
        $response['result'] = $result;
        if($result){
            $msg = "Keratomery Added";
            $response['message'] = $msg;
            $response['keratomeryId'] = $keratomeryId;
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
            'firstMerOd' => 'alpha_numeric',
            'firstAxisOd' => 'alpha_numeric',
            'secondMerOd' => 'alpha_numeric',
            'secondAxisOd' => 'alpha_numeric',
            'anteriorAstigmationOd' => 'alpha_numeric',
            'firstMerOs' => 'alpha_numeric',
            'firstAxisOs' => 'alpha_numeric',
            'secondMerOs' => 'alpha_numeric',
            'secondAxisOs' => 'alpha_numeric',
            'anteriorAstigmationOs' => 'alpha_numeric',
        ));
        
/*         $gump->filter_rules(array(
            'convergenceBrisDistance' => 'trim|sanitize_string',
            'convegenceRecoverement' => 'trim|sanitize_string',
            'convergenceXy' => 'trim|sanitize_string',
            'stereoWirtTest' => 'trim|sanitize_string',
            'ocularMotility' => 'trim|sanitize_string',
        )); */
        
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