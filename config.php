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
$client_id      = '';
$client_secret  = '';
$redirect_uri   = 'http://yoursite.com/callback.php';
$scopes[] = "basic_read";
$scopes[] = "extended_read";
$scopes[] = "location_read";
$scopes[] = "friends_read";
$scopes[] = "mood_read";
$scopes[] = "mood_write";
$scopes[] = "move_read";
$scopes[] = "move_write";
$scopes[] = "sleep_read";
$scopes[] = "sleep_write";
$scopes[] = "meal_read";
$scopes[] = "meal_write";
$scopes[] = "weight_read";
$scopes[] = "weight_write";
$scopes[] = "cardiac_read";
$scopes[] = "cardiac_write";
$scopes[] = "generic_event_read";
$scopes[] = "generic_event_write";
$scope = implode(' ', $scopes);