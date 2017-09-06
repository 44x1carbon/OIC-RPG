<?php

namespace App\Domain\Utilities\Entity;

use App\Domain\Utilities\Identifier\IdentifierInterface;
use App\Domain\Utilities\Identifier\IdentifierTrait;

trait EntityTrait
{
    use IdentifierTrait;
    protected $scope;

    function __construct(array $scope)
    {
        $this->scope = new Scope($scope);
    }

    protected function getScope($key)
    {
        return $this->scope->get($key);
    }

    protected function hasScope($key):bool
    {
        return $this->scope->has($key);
    }

    protected function getIdentifierData():array
    {
        $data = [];
        foreach ($this->identifierKeys as $identifierKey) {
            $data[$identifierKey] = $this->getScope($identifierKey);
        }
        return $data;
    }

    public function toArray():array
    {
        return $this->scope->toArray();
    }

    public function equal(IdentifierInterface $id):bool
    {
        $myId = $this->getIdentifier();

    }
}
