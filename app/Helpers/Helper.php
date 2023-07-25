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
