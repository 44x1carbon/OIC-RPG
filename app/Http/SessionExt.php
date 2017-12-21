<?php

namespace App\Http;

trait SessionExt
{
    public function sessionSave(array $data, $parentKey = null)
    {
        foreach ($data as $k => $value) {
            $key = $parentKey . '.' .$k;
            if(is_array($value)) {
                self::sessionSave($value, $key);
            } else {
                session([$key => $value]);
            }
        }
    }
}