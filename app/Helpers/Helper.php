<?php

if (! function_exists('add_numerical_order')) {
    function add_numerical_order($dataList)
    {
        return $dataList->map(function ($item, $index) {
            if ($index < 9) {
                $item->numerical_order = '0' . ($index + 1);
            } else {
                $item->numerical_order = $index + 1;
            }
            return $item;
        });
    }
}

if (! function_exists('validate_parameter')) {
    function validate_parameter($param)
    {
        if (!isset($param) || empty($param)) {
            return false;
        }
        return true;
    }
}

if (!function_exists('validate_id')) {
    function validate_id($id)
    {
        if (!isset($id) || empty($id)) {
            return false;
        }

        if (!is_numeric($id) || intval($id) <= 0) {
            return false;
        }

        return true;
    }
}

