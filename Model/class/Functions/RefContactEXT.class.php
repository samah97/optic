<?php
/**
 * Class that operate on table 'ref_contact'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefContactEXT extends RefContactMySqlDAO{

    
    public function submitData($data = null,$pdo = null)
    {
        $refContactOj = new RefContactMySqlExtDAO();
        $validateData = $this->validateData($data);
        
        $result = true;
        if ($validateData['result']) {
            $data = (object)$validateData['data'];
            
            $refContactId = $refContactOj->insertPDO($pdo, $data);
            if(!$refContactId){
                $result = false;
                $msg = "Something went wrong";
            }
        }else{
            $result = false;
        }
        
        $response['result'] = $result;
        if($result){
            $response['refContactId'] = $refContactId;
        }else{
            $response['errors'] = $validateData['errors'];
        }
        
        return $response;
    }
    
    private function validateData($data){
        $data = (array)$data;
        $gump = new GUMP();
        
        $data= $gump->sanitize($data);
        
        $gump->validation_rules(array(
            'sphereOd'    => 'required|numeric',
            'sphereOs'    => 'required|numeric',
            'cylinderOd'       => 'numeric',
            'cylinderOs'       => 'numeric',
            'axisOd'        => 'numeric',
            'axisOs'        => 'numeric',
            'wearTypeId'       => 'integer',
            'brand'       => 'alpha_space',
            'dk'       => 'alpha_space',
            'reasonIsPrerred'       => 'alpha_space',
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