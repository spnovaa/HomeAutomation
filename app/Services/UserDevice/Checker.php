<?php

namespace App\Services\UserDevice;


abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check($device);

    public function succeedWith($successor)
    {
        $this->successor = $successor;
    }

    public function next($device)
    {
        if (isset($this->successor)) {
            $this->successor->check($device);
        }
    }
}
