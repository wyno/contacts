<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 6:35 PM
    */

    namespace Wyno\Engine;

    /**
     * Class Helpers
     *
     * @package Wyno\Engine
     */
    class Helpers
    {
        /**
         * Extend an object properties.
         *
         * @param $object
         * @param $properties
         *
         * @return mixed
         */
        public static function extend($object, $properties)
        {
            foreach ($properties as $name => $value) {
                $default = $object->{$name};
                if (is_array($default)) {
                    $object->{$name} = static::mergeRecursiveDistinct($default, $value);
                } else {
                    $object->{$name} = $value;
                }
            }
            return $object;
        }

        /**
         * Merge two array recursive and distinct.
         *
         * @param array $array1
         * @param array $array2
         *
         * @return array
         */
        public static function mergeRecursiveDistinct(array $array1, array $array2)
        {
            $merged = $array1;
            foreach ($array2 as $key => &$value) {
                if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                    $merged[$key] = static::mergeRecursiveDistinct($merged[$key], $value);
                } else {
                    $merged[is_int($key) ? null : $key] = $value;
                }
            }
            return $merged;
        }

    }