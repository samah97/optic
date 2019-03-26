<?php
/**
 * Class that operate on table 'ref_eyeglasses'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefEyeglassesEXT extends RefEyeglassesMySqlDAO{

    public function submitData($data = null,$pdo = null)
    {
        $refEyeglassesObj = new RefEyeglassesMySqlExtDAO();
        $validateData = $this->validateData($data);
        
        $result = true;
        if ($validateData['result']) {
            $data = $validateData['data'];
            
            $dataWhere = array("refractionHistoryId"=>$data->refractionHistoryId);
            $strWhere = " refraction_history_id = :refractionHistoryId";
            $existRefEyeglasses = $refEyeglassesObj->getRecord($pdo, $dataWhere, $strWhere);
            
            if ($existRefEyeglasses->refractionHistoryId > 0) { //UPDATE
                $refEyeglassesId = $existRefEyeglasses->refEyeglassesId;
                    $update = $refEyeglassesObj->updatePDO($pdo, $data);
                    if(!$update){
                        $result = false;
                        $msg = "Something went wrong";
                    }
            } else { //INSERT
                
                $refEyeglassesId = $refEyeglassesObj->insertPDO($pdo, $data);
                if(!$refEyeglassesId){
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
            $response['refEyeglassesId'] = $refEyeglassesId;
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
            'cylinderOs'       => 'numeric',
            'axisOd'       => 'numeric',
            'axisOs'       => 'numeric',
            'addition'       => 'alpha_numeric',
            'pdOd'       => 'alpha_numeric',
            'pdOs'       => 'alpha_numeric',
            'prismOd'       => 'alpha_numeric',
            'prismOs'       => 'alpha_numeric',
            'baseOd'       => 'alpha_numeric',
            'baseOs'       => 'alpha_numeric',
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