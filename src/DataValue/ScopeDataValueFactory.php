<?php

namespace Partigen\DataValue;

class ScopeDataValueFactory
{
    public function create(string $scopeType): ScopeDataInterface
    {
        $class = __NAMESPACE__ . '\\Scope' . $scopeType;
        return new $class();
    }
}
