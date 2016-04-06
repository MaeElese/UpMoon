<?php

/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 05.04.2016
 * Time: 19:55
 */
class callbackController
{
    private $template;

    function __construct(){
        require "php/config.php";
        require "php/callback.php";
        $this->template = file_get_contents('templates/layout.html');
        $content = file_get_contents('templates/application.html');
        $content = str_replace('{$sleeps}', $sleeps["items"]['0']['xid'] , $content);
        $this->template = str_replace('{$content}', $content, $this->template);
    }
    
    function getTemplate(){
        return $this->template;
    }
}