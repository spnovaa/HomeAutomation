<?php

namespace App\Services\User\Delete\Validation\Checkers;

use App\Models\User;
use App\Services\User\Checker;

class SampleChecker extends Checker
{
    public function check(User $user)
    {
        // sample checker. The real checking process may be implemented here.
        if (false)
            throw new \Exception('invalidity message');

        $this->next($user);
    }
}
