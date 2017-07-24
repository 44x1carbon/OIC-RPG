<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2017/04/18
 * Time: 12:56
 */

namespace App\Domain;

trait EntityTrait
{
    protected $id;

    protected $scope;

    public function __construct(int $id, array $scope)
    {
        $this->id = $id;
        $this->scope = new Scope($scope);
    }

    public function getId()
    {
        return $this->id;
    }

    public function equal($id):bool
    {
        return $this->id === $id;
    }

    protected function getScope($key)
    {
        return $this->scope->get($key);
    }

    protected function hasScope($key):bool
    {
        return $this->scope->has($key);
    }

    public function toArray():array
    {
        return $this->scope->toArray();
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
