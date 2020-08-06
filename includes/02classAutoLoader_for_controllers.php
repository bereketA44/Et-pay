<?php
spl_autoload_register(function($classname){
        $path = '../classes-engine/';
        $extension = '.class.php';
        $fullPath = $path.$classname.$extension;
    
    if (!file_exists($fullPath)){
        
        $error_type = 4;
        include_once( './error/00sign_up_err.php');
        return false;
    }
    include_once $fullPath;
})
?>