<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 6:30 PM
    */

    namespace Wyno\Engine;

    /**
     * Class Application
     *
     * @package Wyno\Engine
     * @property-read Request  $request
     * @property-read Router   $router
     * @property-read Response $response
     */
    class Application extends BaseObject
    {
        public $debugEnabled = false;
        private $unknownPropBag = [];
        public $request;
        public $response;
        public $router;
        public $baseUrl;

        /**
         * Application constructor.
         *
         * @param array $config
         *
         * @throws \Exception
         */
        public function __construct(array $config = [])
        {
            // ensure core classes instance
            $this->ensureCoreClassesInstance();

            // super
            parent::__construct($config, array_keys($this->core()));

            // ensure debug flags
            $this->ensureDebugFlag();
        }

        public function __get($name)
        {
            if (property_exists($this, $name))
                return $this->{$name};

            if (method_exists($this, $name))
                return $this->{$name}();

            return isset($this->unknownPropBag[$name]) ? $this->unknownPropBag[$name] : null;
        }

        public function __set($name, $value)
        {
            if (property_exists($name, $name))
                return $this->{$name} = $value;

            if (method_exists($this, $name))
                return call_user_func([$this, $name], $value);

            return $this->unknownPropBag[$name] = $value;
        }

        /**
         * Ensure debug flags.
         *
         * @return void
         */
        private function ensureDebugFlag(): void
        {
            if ($this->debugEnabled) {
                error_reporting(E_ALL);
            } else {
                error_reporting(0);
            }

            // define const
            defined('APP_DEBUG_ENABLED') || define('APP_DEBUG_ENABLED', $this->debugEnabled);
        }

        /**
         * Register routes.
         *
         * @param $routesFile
         */
        public function registerRoutes($routesFile)
        {
            $router = $this->getRouter();
            $router->setBasePath($this->baseUrl);

            if (is_file($routesFile))
                include_once($routesFile);
        }

        /**
         * Core classes.
         *
         * @return array
         */
        private function core()
        {
            return [
                'request'  => "Wyno\\Engine\\Request",
                'response' => "Wyno\\Engine\\Response",
                'router'   => "Wyno\\Engine\\Router"
            ];
        }

        /**
         * Make core classes instance.
         *
         * @return void
         * @throws \Exception
         */
        private function ensureCoreClassesInstance(): void
        {
            foreach ($this->core() as $key => $class) {
                if (!class_exists($class))
                    throw new \Exception("Class {$class} not exists.");

                Helpers::extend($this, [$key => new $class]);
            }
        }

        /**
         * Return request instance.
         *
         * @return Request
         */
        public function getRequest(): Request
        {
            return $this->request;
        }

        /**
         * Return router instance.
         *
         * @return Router
         */
        public function getRouter(): Router
        {
            return $this->router;
        }

        /**
         * Return response instance.
         *
         * @return Response
         */
        public function getResponse(): Response
        {
            return $this->response;
        }


        public function runOrFail($message = null)
        {
            $match = $this->getRouter()->match();

            dd($match['target']($match['parameter']));
        }
    }