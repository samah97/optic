<?php
//FOR SAMAH
define('MAIN_URL','http://localhost/projects/optic/');
define('BASE_URL','http://localhost/projects/optic/');


error_reporting(0);

//FOR EHAB
/* define('MAIN_URL','http://localhost/optic/');
define('BASE_URL','http://localhost/optic/'); */ 

define ( 'PATH', dirname ( __FILE__ ) );
define ( 'BASE_PATH', PATH . '/' );


include_once("global.php");
include_once("config.php");
include_once("connection.php");
include(BASE_PATH."../Model/include_dao.php");

class Common{
    
    public static function CheckValidSession(){
        
        if(trim($_SESSION['session']) == ''){
            return 0;
        }
        
        $query = "SELECT * FROM users where session = '".$_SESSION['session']."'";
        
        $r= exec_query(DBNAME, $query);
        
        $row = mysqli_fetch_assoc($r);
        
        if($row['userId'] > 0){
            return 1;
        }else{
            return 0;
        }
        /* while ($row = mysqli_fetch_assoc($r)) {
            $x = $row['clientId'] .",'".$row['firstname']."','".$row['lastname']."','".$row['phone']."','".$row['DOB']."','".$row['DAttendence']."','".$row['DRecieved']."'";
            $filterQuery= $filterQuery."[".$x."],";
        } */
    }

    
    public static function cryptoo( $string, $action) {
        // you may change these values to your own
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';
        
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
        
        return $output;
    }
   
    public static function clearParameter($txt)
    {
        $wordArray = array(
            "select",
            "union",
            "delete",
            "insert",
            "update",
            "drop",
            "order by",
            "all",
            "(",
            ")",
            "'",
            "/",
            "*",
            ";",
            "**",
            "''",
            "admin",
            "cms",
            "user",
            "="
        );
        $txt = preg_replace("/[^a-zA-Z-0-9- \.]/", "", $txt);
        for ($i = 0; $i < count($wordArray); $i ++) {
            $txt = str_ireplace($wordArray[$i], "", $txt);
        }
        $txt = Common::quote_smart($txt);
        return $txt;
    }
    
    public static function quote_smart($value)
    {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        return $value;
    }
    
    public static function formatDate($date,$mainformat="Y-m-d",$format = 'j/m/Y'){
        $date = trim($date);
        $date = date_create_from_format($mainformat,$date);
        return date_format($date, $format);
    }
    
    
}


?>

