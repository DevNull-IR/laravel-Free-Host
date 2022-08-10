<?php

namespace DevNullIr\LaravelFreeHost\core\traits;

trait setDefault
{
    protected $Default = [];

    public function setDefault(array $array = []): bool
    {
        $array = [...$array, ...$this->Default];

        return (bool) $this->Default = $array;
    }
}
