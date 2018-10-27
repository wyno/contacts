<?php
    /*
    | Author : Ata amini
    | Email  : ata.aminie@gmail.com
    | Date   : 2018-10-27
    | TIME   : 6:47 PM
    */

    function dd()
    {
        ttt();
        $args = func_get_args();
        call_user_func_array('var_dump', $args);
        exit();
    }

    function ttt()
    {
        $args = func_get_args();
        $trace = debug_backtrace();
        if (isset($trace[1])) {
            $trace = $trace[1];
            $file = str_replace($_SERVER['DOCUMENT_ROOT'], '', $trace['file']);
            echo "<pre><b>Called in: </b></br>{$file}:{$trace['line']}</pre><br>";
        }
    }

    return [
        'baseUrl'      => 'htdocs/contacts/',
        'debugEnabled' => 0
    ];