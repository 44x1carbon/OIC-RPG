<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2017/04/18
 * Time: 12:55
 */

namespace App\Domain;

interface EntityInterface
{
    public function equal($id):bool;

    public function toArray():array ;
}
