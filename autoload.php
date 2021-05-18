<?php

require __DIR__ . '/vendor/autoload.php';

/*spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});*/

function dump($data){
    echo '<pre>' . print_r($data, true) . '</pre>';
}
