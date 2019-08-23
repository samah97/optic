<?php
/**
 * Class that operate on table 'brand'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-05-13 21:08
 */
class BrandEXT extends BrandMySqlDAO{

	public function getAllRecords($data = array(),$strWhere = " 1 ",$order= " 1 ASC",$limit = PHP_INT_MAX,$offset = 0){
	    $pdo = Database::getConnection();
	    $Obj = new BrandMySqlExtDAO();
	    return $Obj->getAllRecords($pdo,$data,$strWhere,$order,$limit,$offset);
	}
	
	public function editBrands()
	{

        $post = file_get_contents('php://input');
        print_r($post);die();
	    $post = json_decode($post);
	    
	    
	    $formData = $post->data;
	    
	    $pdo = Database::getConnection();
	    $pdo->beginTransaction();
	    $result = true;
        print_r($formData);die();
	    $brandObj = new BrandMySqlExtDAO();
	    foreach($formData as $dataRow){
	        $brandsDuplicateArray = [];
	        if(!empty($dataRow->name)){
	            if(!in_array($dataRow->name, $brandsDuplicateArray)){
	                if($dataRow->flag == 1){ //INSERT
	                    $brand = new Brand();
	                    $brand->name = $dataRow->name;
	                    $updatedId = $brandObj->insertPDO($pdo, $brand);
	                    if(!$updatedId){
	                        $result = false;
	                        $error = 'Something went wrong';
	                    }
	                }elseif($dataRow->flag == 2 || $dataRow->flag == 3){ //UPDATE & DELETE
                        $existBrand = $brandObj->loadPDO($pdo, $dataRow->brandId);
                        if($existBrand->brandId > 0){
                            $existBrand->name = name;
                            if($dataRow->flag == 2){ //UPDATE
                                $updatedId = $brandObj->updatePDO($pdo, $existBrand," brand_id = ".$existBrand->brandId);
                                if(!$updatedId){
                                    $result = false;
                                    $error = 'Something went wrong';
                                }
                            }elseif($dataRow->flag == 3){ //DELETE
                                $deletedId = $brandObj->deletePDO($pdo, "brand_id = ".$existBrand->brandId);
                                if(!$deletedId){
                                    $result = false;
                                    $error = 'Something went wrong';
                                }
                            }
                        }else{
                            $result = false;
                            $error = 'Invalid Brand';
                        }
	                }
	            }else{
	                $result = false;
	                $error = "Duplicate Name: ".$dataRow->name;
	            }
	        }else{
	            $result = false;
	            $error = 'Invalid Brand Name';
	        }
	    }
	    
	    if($result){
	        $pdo->commit();
	        $response = array(
	            "result"=>true,
	            "message" => "Data has been saved successfully"
	        );
	    }else{
	        $pdo->rollBack();
	        $response = array(
	            "result"=>false,
	            "errors" => $errors
	        );
	    }
	    
	    return $response;
	}
	
}
?>