<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 6:32 PM
    */

    namespace Wyno\Engine;

    /**
     * Class Configurable
     *
     * @package Wyno\Engine
     */
    class Configurable
    {
        /**
         * Configure and set class properties if exists.
         *
         * @param array $config
         * @param array $except
         */
        public function __construct($config = [], array $except = [])
        {
            if (!empty($config)) {
                // remove excepted items
                foreach ($except as $item)
                    unset($config[$item]);

                // extend configuration
                Helpers::extend($this, $config);
            }

            // initialize
            $this->init();
        }

        /**
         * Initialize method, execute after construct.
         *
         * @return void
         */
        public function init(): void
        {
            // stuff
        }
    }