<?php

/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 05.04.2016
 * Time: 20:06
 */
class connectController
{
    
    function __construct()
    {
        require 'php/config.php';
        $param = array(
            'response_type' => 'code',
            'client_id' => $client_id,
            'scope' => $scope,
            'redirect_uri' => $redirect_uri
        );
        $url = "https://jawbone.com/auth/oauth2/auth?" . http_build_query($param);
        header("Location: {$url}");
        exit;
    }
}