<?php

declare(strict_types=1);

namespace App\Entity;

abstract class AbstractEntity
{
    abstract protected function _toArray(): array;

    protected function prepareAttributeForPersisting(array $attributes): array
    {
        return array_map(function($attribute) {
            if($attribute instanceof \DateTime) 
            {
                return $attribute->format('Y-m-d H:i:s');
            } 
            return $attribute;
        },
        $attributes);
    }

    final public function toArray()
    {
        $attributes = $this->_toArray();
        return $this->prepareAttributeForPersisting($attributes);
    }
}
