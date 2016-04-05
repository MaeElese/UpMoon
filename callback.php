<?php
/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 01.04.2016
 * Time: 12:19
 */
require 'config.php';
$error = false;
if(isset($_GET['error']) || !isset($_GET['code']) || empty($_GET['code'])){
    $error = true;
}else{
    $param = array(
        'grant_type' => 'authorization_code',
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code']
    );

    $url = "https://jawbone.com/auth/oauth2/token?" . http_build_query($param);
    $body = file_get_contents($url);
    $json = json_decode($body, true);

    if(isset($json['access_token'])){
        $user = getUser($json['access_token']);
    }else{
        $user = array();
    }
}
/**
 * Get basic information about the user
 * @see https://jawbone.com/up/developer/endpoints/user
 */
function getUser($access_token){
    $url = "https://jawbone.com/nudge/api/v.1.0/users/@me";

    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header'=>"Authorization: Bearer {$access_token}\r\n"
        )
    );
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);
    $user = json_decode($response, true);
    return $user['data'];
}

?>
