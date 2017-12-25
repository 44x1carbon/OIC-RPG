<?php

namespace App\Presentation\DTO;

abstract class AbstractDto implements Arrayable
{
    protected static $typeInfo = [];

    protected function setTypeInfo($data) {
        if(is_array($data)) {
            static::$typeInfo = array_map(function($d) { return new TypeInfo($d[0], $d[1]); }, $data);
        } else {
            static::$typeInfo = [new TypeInfo($data[0], $data[1])];
        }
    }

    private static function findTypeInfo(string $fieldName): ?TypeInfo
    {
        $result = array_filter(self::$typeInfo, function(TypeInfo $typeInfo) use($fieldName) { return $typeInfo->fieldName === $fieldName; });
        $result = array_values($result);

        if(count($result) === 0) return null;
        return $result[0];
    }

    public function toArray(): array
    {
        $thisKeys = array_map(function($key) {
            $exploded = explode("\x00", $key);
            return $exploded[count($exploded) -1];
        }, array_keys((array) $this));


        $thisValues = array_values((array) $this);
        $array = [];
        foreach ($thisKeys as $index => $key) {
            $array[$key] = $thisValues[$index];
        }
        unset($array['typeInfo']);
        var_dump($array);
        $arrayableToArray = function($property) {
            if($property instanceof Arrayable) return $property->toArray();
            else return $property;
        };
        
        return array_map(function($property) use($arrayableToArray){
            if(is_array($property)) return array_map($arrayableToArray, $property);
            else return $arrayableToArray($property);
        }, $array);
    }

    public static function fromArray(array $data)
    {
        $self = new static();
        foreach ($data as $key => $value) {
            $typeInfo = self::findTypeInfo($key);
            if(is_null($typeInfo)) $self->{$key} = $value;
            else {
                $self->{$key} = call_user_func([$typeInfo->typePath, 'fromArray'], $value);
            }
        }

        return $self;
    }
}

class TypeInfo
{
    function __construct(string $fieldName, string $typePath)
    {
        $this->fieldName = $fieldName;
        $this->typePath = $typePath;
    }
}