<?php

namespace App\Services\User;


use App\Models\Device;
use App\Models\User;

abstract class Checker
{
    protected ?Checker $successor;

    abstract public function check(User $user);

    public function succeedWith(Checker $successor)
    {
        $this->successor = $successor;
    }

    public function next(User $user)
    {
        if (isset($this->successor)) {
            $this->successor->check($user);
        }
    }
}
