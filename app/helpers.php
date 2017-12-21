<?php

if (! function_exists('null_safety')) {

    /**
     * 第一引数で受け取った値がnullならnullを
     * nullでなければ第二引数で受け取った関数の第一引数に$valueを渡し、実行した結果を返す。
     *
     * @param $value
     * @param callable $func
     * @return null | mixed
     */
    function null_safety($value, callable $func)
    {
        if(is_null($value)) return $value;
        return $func($value);
    }
}

if (! function_exists('is_assoc')) {
    function is_assoc(&$data)
    {
        if (!is_array($data)) {
            return false;
        }

        $keys = array_keys($data);
        $range = range(0, count($data) - 1);
        foreach ($keys as $i => $value) {
            if (!is_int($value) || $value !== $range[$i]) {
                return false;
            }
        }

        return true;
    }
}