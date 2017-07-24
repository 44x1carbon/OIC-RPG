<?php

namespace App\Domain;

use Carbon\Carbon;

trait ValueObjectTrait
{
    public function __construct(array $data)
    {
        foreach ($this as $key=>$value) {
            $this->{$key} = array_get($data, $key, $value);
        }
    }

    public function toArray():array
    {
        $data = [];
        foreach ($this as $key => $value) {
            if ($value instanceof Carbon) {
                $data[$key] = $value->format("Y/m/d H:i:s");
            } else {
                $data[$key] = $value;
            }
        }
        return $data;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
