<?php

namespace App\Traits;

trait JsonSerializable
{

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}