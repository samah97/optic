<?php

/**
 * Class that operate on table 'users'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2019-02-17 10:56
 */
class UsersEXT extends UsersMySqlDAO
{

    public function login($username,$password)
    {
        
        $response = new stdClass();
        
        if ($username != '' && $password != '') {
            
            $pdo = Database::getConnection();
            
            $md5Password = md5($password);
            
            $userObj = new UsersMySqlExtDAO();
            $user = $userObj->getUser($pdo, $username, $md5Password);
            
            if ($user->userId > 0) {
                $result = true;
                $message = "Logged In";
            }else{
                $result = false;
                $message = "Invalid username or password";
            }
        } else {
            $result = false;
            $message = "Invalid username or password";
        }
        
        $response->result = $result;
        $response->message = $message;
        if($result){
            $response->user = $user;    
        }
        
        return $response;
    }
}
?>