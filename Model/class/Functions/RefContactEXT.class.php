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
            $data = $validateData['data'];
            
            $dataWhere = array("refractionHistoryId"=>$data->refractionHistoryId);
            $strWhere = " refraction_history_id = :refractionHistoryId";
            $existRefEyeglasses = $refContactOj->getRecord($pdo, $dataWhere, $strWhere);
            
            if ($existRefEyeglasses->refractionHistoryId > 0) { //UPDATE
                $refContactId = $existRefEyeglasses->refContactId;
                $update = $refContactOj->updatePDO($pdo, $data);
                if(!$update){
                    $result = false;
                    $msg = "Something went wrong";
                }
            } else { //INSERT
                
                $refContactId = $refContactOj->insertPDO($pdo, $data);
                if(!$refContactId){
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
            $response['refContactId'] = $refContactId;
        }else{
            $response['errors'] = $msg;
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
            'cylinderOs'       => 'numeric'
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