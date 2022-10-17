<?php

namespace App\Entity;

use DateTime;

abstract class AbstractEntity
{
    /** @return array<mixed> */
    abstract protected function _toArray(): array;

    /**
     * @param array<mixed> $attributes 
     * @return array<mixed>
     */
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

    /** @return array<mixed> */
    final public function toArray(): array
    {
        $attributes = $this->_toArray();
        return $this->prepareAttributeForPersisting($attributes);
    }
}
