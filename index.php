<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 6:31 PM
    */

    // import base application
    require(__DIR__ . '/src/Engine/BaseApplication.php');

    // require application class
    require(APP_SRC . '/Engine/Application.php');

    // application configuration
    $configuration = require(APP_SRC . '/Config/Config.php');

    // create new instance of application
    $application = new \Wyno\Engine\Application($configuration);

    // register routes
    $application->registerRoutes(APP_SRC . '/Config/Routes.php');

    // run application
    $application->runOrFail();
