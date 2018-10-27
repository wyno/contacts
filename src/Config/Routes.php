<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 8:51 PM
    */

    /** @var \Wyno\Engine\Router $router Router instance */

    if (!isset($router) || !$router instanceof \Wyno\Engine\Router)
        return false;

    $router->map('GET|POST', '/', 'home#index', 'home');

    function sample($input = null){
        dd("Calling {$input}");
    }


    $router->map('GET', '/users/[i:id]', 'sample', 'test.test');