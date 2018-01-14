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

if (! function_exists('is_any')) {
    /**
     * @param array $data
     * @param bool|Closure $check
     * @return bool
     */
    function is_any(array $data, $check = true) {
        if(count($data) == 0) return false;
        $results = array_map(function($d) use($check) {
            if(is_object($check) && $check instanceof Closure) return $check($d);
            return $d == $check;
        }, $data);

        return in_array(true, $results);
    }
}

if (! function_exists('is_all')) {
    /**
     * @param array $data
     * @param bool|Closure $check
     * @return bool
     */
    function is_all(array $data, $check = true) {
        if(count($data) == 0) return false;
        $results = array_map(function($d) use($check) {
            if(is_object($check) && $check instanceof Closure) return $check($d);
            return $d == $check;
        }, $data);

        return !in_array(false, $results);
    }
}