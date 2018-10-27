<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 8:17 PM
    */

    namespace Wyno\Engine;


    /**
     * Class Singleton
     *
     * @package Wyno\Engine
     */
    class Singleton extends BaseObject
    {
        private static $uniqueInstance = null;

        public static function getInstance()
        {
            if (self::$uniqueInstance === null) {
                self::$uniqueInstance = new self;
            }

            return self::$uniqueInstance;
        }

        private function __clone()
        {
        }
    }