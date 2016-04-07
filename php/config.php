<?php
/**
 * Created by PhpStorm.
 * User: Mae
 * Date: 31.03.16
 * Time: 23:17
 */
/*
 * Modify the variables below for your app
 * @see https://jawbone.com/up/developer/
 */
$client_id      = '8Js4ZTEMnD4';
$client_secret  = '16227963ad13cb5f64d6f90076570b3e0583106c';
$redirect_uri   = 'http://localhost/UpMoon/index.php?page=callback';
$scopes[] = "basic_read";
$scopes[] = "extended_read";
$scopes[] = "location_read";
$scopes[] = "move_read";
$scopes[] = "move_write";
$scopes[] = "sleep_read";
$scopes[] = "sleep_write";
$scopes[] = "generic_event_read";
$scopes[] = "generic_event_write";
$scope = implode(' ', $scopes);
