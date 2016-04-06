<?php

/**
 * Created by PhpStorm.
 * User: pfeifer
 * Date: 05.04.2016
 * Time: 19:24
 */
class mapper
{
    private $whitelist = array("start", "connect", "callback");

    function __construct()
    {
        if(isset($_GET["page"])){
            if(in_array($_GET["page"], $this->whitelist)){
                $controllerString = $_GET["page"] . "Controller";
                $content = new $controllerString();
                echo $content->getTemplate();
            }else{
                $content = new startController();
                echo $content->getTemplate();
            }
        }else{
            $content = new startController();
            echo $content->getTemplate();
        }

    }
}