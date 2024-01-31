<?php

namespace App\Services\User;


use App\Models\Device;
use App\Models\User;

abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check($obj);

    public function succeedWith(Checker $successor)
    {
        $this->successor = $successor;
    }

    public function next($obj)
    {
        if (isset($this->successor)) {
            $this->successor->check($obj);
        }
    }
}
