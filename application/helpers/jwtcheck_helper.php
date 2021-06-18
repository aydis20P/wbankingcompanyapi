<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Firebase\JWT\JWT;


/**
 * get access token from header
 * */
function getBearerToken() {

    //Get header Authorization
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }


    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}


function validateToken($jwt) {

    echo $jwt;
    $key = getenv('KEY');
    try{
        $data = JWT::decode($jwt, $key, array('HS256'));
        return TRUE;
    }
    catch(Exception $e) {
        throw $e;
    }
}


if ( ! function_exists('jwtValidation()'))
{
    function jwtValidation(){
        //get Bearer token
        $bearerToken = getBearerToken();
        //jwt validate
        try{
            validateToken($bearerToken);
        }
        catch(Exception $e){
            throw $e;
        }
    }
}
