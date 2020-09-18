<?php

namespace App\Core;

class DataObject
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    public function __unset($key)
    {
        unset($this->data[$key]);
        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function __call($name, $arguments)
    {
        $key = strtolower(substr($name, 3));

        switch (substr($name, 0, 3)) {
            case 'get':
                return $this->__get($key);
            case 'set':
                return $this->__set($key, $arguments[0]);
            case 'uns':
                return $this->__unset($key);
            case 'has':
                return $this->__isset($key);
        }

        return $this;
    }
}
