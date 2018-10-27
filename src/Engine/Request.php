<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 8:09 PM
    */

    namespace Wyno\Engine;

    /**
     * Class Request
     *
     * @package Wyno\Engine
     */
    class Request extends Singleton
    {
        /**
         * Return request method.
         *
         * @return string
         */
        public function getMethod(): string
        {
            if (isset($_SERVER['REQUEST_METHOD']))
                return strtoupper($_SERVER['REQUEST_METHOD']);
            return 'GET';
        }

        /**
         * Determine is http GET method.
         *
         * @return bool
         */
        public function isGet(): bool
        {
            return 'GET' === $this->getMethod();
        }

        /**
         * Determine is http POST method.
         *
         * @return bool
         */
        public function isPost(): bool
        {
            return 'POST' === $this->getMethod();
        }

        /**
         * Determine is http DELETE method.
         *
         * @return bool
         */
        public function isDelete(): bool
        {
            return 'DELETE' === $this->getMethod();
        }
    }