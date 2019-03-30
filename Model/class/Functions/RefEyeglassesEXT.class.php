<?php

/**
 * Class that operate on table 'ref_eyeglasses'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:44
 */
class RefEyeglassesEXT extends RefEyeglassesMySqlDAO
{

    public function submitData($data = null, $pdo = null)
    {
        $refEyeglassesObj = new RefEyeglassesMySqlExtDAO();
        $validateData = $this->validateData($data);
        
        $result = true;
        if ($validateData['result']) {
            $data = (object) $validateData['data'];
            $refEyeglassesId = $refEyeglassesObj->insertPDO($pdo, $data);
            if (! $refEyeglassesId) {
                $result = false;
                $msg = "Something went wrong";
            }
        } else {
            $result = false;
        }
        
        $response['result'] = $result;
        if ($result) {
            $response['refEyeglassesId'] = $refEyeglassesId;
        } else {
            $response['errors'] = $validateData['errors'];
        }
        
        return $response;
    }

    private function validateData($data)
    {
        $data = (array) $data;
        $gump = new GUMP();
        
        $data = $gump->sanitize($data);
        
        $gump->validation_rules(array(
            'sphereOd' => 'required|numeric',
            'sphereOs' => 'required|numeric',
            'cylinderOd' => 'numeric',
            'cylinderOs' => 'numeric',
            'axisOd' => 'numeric',
            'axisOs' => 'numeric',
            'addition' => 'alpha_space',
            'pdOd' => 'alpha_space',
            'pdOs' => 'alpha_space',
            'prismOd' => 'alpha_space',
            'prismOs' => 'alpha_space',
            'baseOd' => 'alpha_space',
            'baseOs' => 'alpha_space'
        ));
        
        $validated_data = $gump->run($data);
        
        if ($validated_data) {
            $returnArr['data'] = $validated_data;
            $returnArr['result'] = true;
        } else {
            $returnArr['result'] = false;
            $returnArr['errors'] = $gump->get_errors_array();
        }
        
        return $returnArr;
    }
}
?>