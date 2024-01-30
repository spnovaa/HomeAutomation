<?php

namespace App\Services\Device;


use App\Models\Device;

abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check(Device $device);

    public function succeedWith(Checker $successor)
    {
        $this->successor = $successor;
    }

    public function next(Device $device)
    {
        if (isset($this->successor)) {
            $this->successor->check($device);
        }
    }
}
