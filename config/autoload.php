<?php
    spl_autoload_register(function($classCall){
        $classPath = str_replace("_" , "/" , $classCall);
        require_once "../app/" . $classPath . ".php";
    })
?>