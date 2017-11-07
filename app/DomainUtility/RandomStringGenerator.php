<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/03
 * Time: 13:27
 */

namespace App\DomainUtility;


class RandomStringGenerator
{
    /**
     * ランダム文字列生成 (英小文字)
     * $length: 生成する文字数
     */
    public static function makeLowerCase($length)
    {
        static $chars = 'abcdefghijklmnopqrstuvwxyz';
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $chars[mt_rand(0, 25)];
        }
        return $str;
    }
}