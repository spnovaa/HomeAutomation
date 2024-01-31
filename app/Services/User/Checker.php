<?php

namespace App\Services\User;


abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check($obj);

    public function succeedWith($successor)
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
