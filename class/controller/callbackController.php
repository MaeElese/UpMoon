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
        //Abruf der Templates
        $this->template = file_get_contents('templates/layout.html');
        $content = file_get_contents('templates/application.html');
        //Platzhalter füllen
        $content = str_replace('{$image}', $image , $content);
        $content = str_replace('{$date}', $date , $content);
        $content = str_replace('{$length}', $length , $content);
        $content = str_replace('{$quality}', $quality , $content);
        $content = str_replace('{$moonimage}', $displayMoon , $content);
        $content = str_replace('{$stage}', $stage , $content);
        $content = str_replace('{$age}', $age , $content);
        $content = str_replace('{$illumination}', $illumination , $content);
        $content = str_replace('{$influence}', $influence , $content);
        //Aufbau der Seite
        $this->template = str_replace('{$content}', $content, $this->template);
    }
    
    function getTemplate(){
        return $this->template;
    }
}