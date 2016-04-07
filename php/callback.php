<?php
/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 01.04.2016
 * Time: 12:19
 */
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
        $sleeps = getSleep($json['access_token']);
        $currentSleeps = getCurrentSleep($json['access_token'], $sleeps);
        $image = getImage($currentSleeps);
        $currentMoon = getMoon($currentSleeps);
        $displayMoon = displayMoon($currentMoon, $currentSleeps);
    }
        else{
        $user = array();
        $sleeps = array();
        $currentSleeps = array();
            $image = "no image";
            $currentMoon = "no date available";
            $displayMoon = "no image available";
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

function getSleep($access_token){
    $url = "https://jawbone.com/nudge/api/v.1.0/users/@me/sleeps";

    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header'=>"Authorization: Bearer {$access_token}\r\n"
        )
    );
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);
    $sleeps = json_decode($response, true);
    return $sleeps['data'];
}
function getCurrentSleep($access_token, $sleeps){
    $xid = $sleeps["items"]['0']['xid'];
    $url1 = 'https://jawbone.com/nudge/api/v.1.1/sleeps/';
    $url = $url1 . $xid;
    $opts = array(
        'http'=>array(
            'method'=>"GET",
            'header'=>"Authorization: Bearer {$access_token}\r\n"
        )
    );
    $context = stream_context_create($opts);
    $response = file_get_contents($url, false, $context);
    $currentSleeps = json_decode($response, true);
    return $currentSleeps['data'];
}

function getImage($currentSleeps){
    $url1 = 'https://jawbone.com/';
    $url2 = $currentSleeps['snapshot_image'];
    $image= $url1 . $url2;
    return $image;
}
function getMoon($currentSleeps){
    $moon = ('http://api.burningsoul.in/moon/');
    $time = $currentSleeps['time_created'];
    $currentMoonUrl = $moon . $time;
    $moonJson = file_get_contents($currentMoonUrl);
    $currentMoon = json_decode($moonJson, true);
    return $currentMoon;
}

function displayMoon ($currentMoon, $currentSleep){
    $stage = $currentMoon['stage'];
    $newmoon = $currentMoon['FM']['UT'];
    $fullmoon = $currentMoon['NNM']['UT'];
    $time = $currentSleep['time_created'];

    if ($stage === 'waning' && $newmoon != $time && $fullmoon != $time ){
        return('<img src="images/waning.png" >');
    }
    elseif ($stage === 'waxing' && $newmoon != $time && $fullmoon != $time ){
        return('<img src="images/waxing.png" >');
    }
    elseif ($newmoon == $time){
        return('<img src="images/newmoon.png" >');
    }
    elseif ($fullmoon == $time ){
        return('<img src="images/fullmoon.png" >');
    }
}

