<?php

function __autoload($class)
{
    $paths = array(
        '/components/',
        '/models/',
        '/functions/'
    );

    foreach($paths as $path)
    {
        $classFile = ROOT . $path . $class . '.php';
        if (file_exists($classFile))
            include_once $classFile;
    }
}