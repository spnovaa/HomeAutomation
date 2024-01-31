<?php

namespace App\Services\Device\Delete\Validation\Checkers;

use App\Models\User;
use App\Services\User\Checker;

class SampleChecker extends Checker
{
    public function check($user)
    {
        // sample checker. The real checking process may be implemented here.
        if (false)
            throw new \Exception('invalidity message');

        $this->next($user);
    }
}
