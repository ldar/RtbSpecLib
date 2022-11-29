<?php

namespace Ldar\RtbSpecLib;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class Model
 * @package Ldar\RtbSpecLib
 */
abstract class Model
{
    private array $errors = [];
    protected ?array $array = null;
    protected ?string $json = null;

    /**
     * @param $values
     * @return bool
     */
    public function load($values): bool
    {
        if (!is_array($values) || !count($values)) {
            $this->addError('Failed Load data');
            return false;
        }
        foreach ($values as $name => $value) {
            if (is_null($value)) {
                continue;
            }
            $method = 'set' . ucfirst($name);
            switch (true) {
                case method_exists($this, $method):
                    $this->{$method}($value);
                    break;
                case property_exists($this, $name):
                    $this->$name = $value;
                    break;
            }
        }
        return true;
    }

    abstract public function asArray(): array;

    abstract public function validate(): bool;

    /**
     * @return false|string|null
     */
    public function asJson()
    {
        if (is_null($this->json)) {
            $this->json = json_encode($this->asArray(), true);
        }
        return $this->json;
    }

    public function hasErrors(): bool
    {
        return (bool)$this->errors;
    }

    public function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function resetErrors(): void
    {
        $this->errors = [];
    }

    public function getErrorsAsString(): string
    {
        return join(', ', $this->errors);
    }

    public function __clone()
    {
        $this->resetErrors();
        $this->array = null;
        $this->json = null;
    }
}