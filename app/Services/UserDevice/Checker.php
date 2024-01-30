<?php

namespace App\Services\UserDevice;


use App\Models\UserDevices;

abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check(UserDevices $device);

    public function succeedWith(Checker $successor)
    {
        $this->successor = $successor;
    }

    public function next(UserDevices $device)
    {
        if (isset($this->successor)) {
            $this->successor->check($device);
        }
    }
}
