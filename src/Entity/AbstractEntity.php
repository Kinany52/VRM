<?php

declare(strict_types=1);

namespace App\Entity;

abstract class AbstractEntity
{

    abstract public function toArray();

    protected function prepareAttributeForPersisting(array $attributes): array
    {
        return array_map(function($attribute) {
            if($attribute instanceof \DateTimeInterface) 
            {
                return $attribute->format('Y-m-d H:i:s');
            } 
            return $attribute;
        },
        $attributes);
    }
}
