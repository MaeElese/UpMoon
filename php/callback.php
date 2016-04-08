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
        //User Information
        $user = getUser($json['access_token']);
        //Allgemeine Sleeplist
        $sleeps = getSleep($json['access_token']);
        //Aktuelle Sleeplist aus dem 0. Array von Sleeps geholte xId
        $currentSleeps = getCurrentSleep($json['access_token'], $sleeps);
        //Aktueller Schlafgraph
        $image = getImage($currentSleeps);
        //Mond-API-Abruf
        $currentMoon = getMoon($currentSleeps);
        //Display auf Grundlage Moon-API
        $displayMoon = displayMoon($currentMoon, $currentSleeps);
        //Aktuelles Datum des Schlafs
        $date = currentSleepDate($currentSleeps);
        //Aktuelle Länge des Schlafs
        $length = currentSleepLength($currentSleeps);
        //Zielerreichung
        $quality = currentSleepQuality($currentSleeps);
        //Moon-Details
        $age = getMoonAge($currentMoon);
        $stage = getMoonStage($currentMoon);
        $illumination = getMoonLight($currentMoon);
        //Beeinflussung
        $influence = calculateInfluence($currentSleeps, $currentMoon);
        $user_xid = getUserXId($user);
        $sleep_xid = getSleepXId($currentSleeps);
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
function getUserXId($user){
    $user_xid = $user['xid'];
    return $user_xid;
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
    if(isset($_GET['dateId'])){
        if(isset($sleeps["items"][$_GET['dateId']]['xid'])){
            $xid = $sleeps["items"][$_GET['dateId']]['xid'];
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
        }else{
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
    }else{
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

}
function getSleepXId($currentSleeps){
    $sleep_xid = $currentSleeps['xid'];
    return $sleep_xid;
}

function getImage($currentSleeps){
    $url1 = 'https://jawbone.com/';
    $url2 = $currentSleeps['snapshot_image'];
    $image= $url1 . $url2;
    return $image;
}
function currentSleepDate ($currentSleeps){
    $stamp = $currentSleeps['time_created'];
    $date = date("d.m.Y", $stamp);
    return $date;
}
function currentSleepLength ($currentSleeps){
    $length = $currentSleeps['title'];
    return $length;
}
function currentSleepQuality ($currentSleeps)
{
    $quality = $currentSleeps['details']['quality'];
    return $quality;
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
function getMoonStage ($currentMoon){
    $stage = $currentMoon['stage'];
    return $stage;
}
function getMoonAge ($currentMoon){
    $age = $currentMoon['age'];
    return $age;
}
function getMoonLight ($currentMoon)
{
    $illumination = $currentMoon['illumination'];
    return $illumination;
}
function calculateInfluence ($currentSleep, $currentMoon){
    $illumination = $currentMoon['illumination'];
    $quality = $currentSleep['details']['quality'];
    if ($illumination >= 60 && $quality <=60){
        return ('<p> Dein Schlaf war wahrscheinlich beeinflusst</p>');
    }
    elseif ($illumination <= 60 && $quality >=60){
        return ('<p> Dein Schlaf war wahrscheinlich nicht beeinflusst</p>');
    }
}
