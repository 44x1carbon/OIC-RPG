<?php

if (! function_exists('null_safety')) {

    /**
     * 第一引数で受け取った値がnullならnullを
     * nullでなければ第二引数で受け取った関数の第一引数に$valueを渡し、実行した結果を返す。
     *
     * @param $value
     * @param callable $func
     * @return mixed
     */
    function null_safety($value, callable $func)
    {
        if(is_null($value)) return $value;
        return $func($value);
    }
}