<?php

spl_autoload_register(function(string $classname) {
    $load = function($dir, $classname){
        $classfile = "/var/www/$dir/".preg_replace('/^(\w*\/\w*)/', '$1/src', 
            str_replace('\\', '/', $classname)
        ).'.php';
        if (file_exists($classfile)) {
            require_once $classfile;
        }
    };
    $load('vendor', $classname);
    $load('src', $classname);
});
