<?php

namespace App\Utilities;

class SkillExpDictionary
{
    //ToDo Jsonファイルに置き換える
    static $table = [
        1 => 100,
        2 => 200,
    ];

    public static function getNeedExp(int $level):int
    {
        if(array_has(self::$tablem, $level)) throw new \Exception("Undefined offset");
        return self::$table[$level];
    }
}