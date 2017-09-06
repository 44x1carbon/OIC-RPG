<?php

namespace App\Domain\Utilities\ValueObject;

use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use ReflectionFunction;

abstract class AbstractValueObject implements ValueObjectInterface
{
    protected $rules =[];
    private $validates = [];

    public function __construct(array $data)
    {
        /* VOの項目でnullは許されないので
         * $dataにVOの全項目が入っているかの判定
        */
        $this->checkArgsDataComplete($data);

        /*
         * データが正しいかの判定
        */
        $this->acceptValidator($data);

        foreach ($this as $key=>$value) {
            $this->{$key} = array_get($data, $key, $value);
        }
    }

    private function checkArgsDataComplete($data)
    {
        $diff_key = array_diff_assoc($this->toArray(), $data);
        if(count($diff_key) > 0) {
            $keys = array_keys($diff_key);
            throw new \Exception('The following items are missing. ' . implode(',', $keys));
        }
    }

    private function acceptValidator($data)
    {
        /* @var Factory $factory */
        $factory = app(Factory::class);
        $validator = $factory->make($data, $this->rules);
        if(!$validator->passes()) {
            throw new ValidationException($validator);
        }

        $errors = [];
        foreach ($this->validates as $key => $validate) {
            $func = new ReflectionFunction($validate);
            $parameters = $func->getParameters();
            foreach($parameters as $parameter)
            {
                $params[] = app($parameter->getClass()->name);
            }

            if(!$func->invokeArgs($params)) $errors[] = $key;
        }
        if(count($errors) > 0) throw new \Exception('バリデーションエラー ' . implode(',', $errors));
    }

    protected function setValidate($key, $func)
    {
        $this->validates[$key] = $func;
    }

    public function toArray():array
    {
        $data = [];
        foreach ($this as $key => $value) {
                $data[$key] = $value;
        }
        return $data;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

}