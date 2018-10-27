<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 6:59 PM
    */

    // Define application root.
    defined('APP_ROOT') || define('APP_ROOT', realpath(dirname(__DIR__) . '/..'));

    // Define application source directory.
    defined('APP_SRC') || define('APP_SRC', APP_ROOT . '/src');

    /**
     * Class BaseApplication
     *
     * @package Engine
     */
    class BaseApplication
    {
        /**
         * Register PSR-4 autoloader.
         *
         * @throws Exception
         */
        public static function registerAutoloader()
        {
            $sourcePath = APP_SRC;
            $composerPath = APP_ROOT . '/composer.json';
            $composer = json_decode(file_get_contents($composerPath), true);

            // throw exception if composer is wrong
            if (!isset($composer['autoload']['psr-4']))
                throw new \Exception("Composer file not found or PSR-4 section not defined.");

            // extract namespaces
            $namespaces = $composer['autoload']['psr-4'];
            foreach ($namespaces as $namespace => $classPaths) {
                if (!is_array($classPaths))
                    $classPaths = [$classPaths];

                // register autoloader
                spl_autoload_register(function ($className) use ($namespace, $classPaths, $sourcePath) {
                    if (preg_match("#^" . preg_quote($namespace) . "#", $className)) {
                        $className = str_replace($namespace, "", $className);
                        $filename = preg_replace("#\\\\#", "/", $className) . ".php";
                        foreach ($classPaths as $classpath) {
                            $fullPath = "{$sourcePath}/{$classpath}/{$filename}";

                            // normalize path
                            $fullPath = preg_replace('/\/{2,}/', '/', $fullPath);

                            // include fine if file exists
                            if (file_exists($fullPath))
                                include_once($fullPath);
                        }
                    }
                });
            }
        }

    }

    // register autoload
    BaseApplication::registerAutoloader();
