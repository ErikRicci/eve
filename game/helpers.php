<?php

if (! function_exists('request')) {
    function request(string $param = null, $default = null) {
        if ($param) {
            $data = \R2SSimpleRouter\Request::all();
            return array_key_exists($param, $data)
                ? $data[$param]
                : $default;
        }
        return new \R2SSimpleRouter\Request;
    }
}

if (! function_exists('dd')) {
    function dd()
    {
        array_map(function($x) { var_dump($x); }, func_get_args()); die;
    }
}
