<?php

/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 05.04.2016
 * Time: 19:55
 */
class startController
{
    private $template;

    function __construct(){
        $this->template = file_get_contents('templates/layout.html');
        $content = file_get_contents('templates/start.html');
        $this->template = str_replace('{$content}', $content, $this->template);
    }
    
    function getTemplate(){
        return $this->template;
    }
}