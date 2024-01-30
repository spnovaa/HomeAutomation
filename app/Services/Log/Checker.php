<?php

namespace App\Services\Log;


use App\Models\Device;
use App\Models\Log;

abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check(Log $log);

    public function succeedWith(Checker $successor)
    {
        $this->successor = $successor;
    }

    public function next(Log $log)
    {
        if (isset($this->successor)) {
            $this->successor->check($log);
        }
    }
}
