<?php

namespace App\Services\User\Create\Validation\Checkers;

use App\Models\Device;
use App\Models\User;
use App\Services\User\Checker;

class SampleChecker extends Checker
{
    public function check($device)
    {
        // sample checker. The real checking process may be implemented here.
        if (false)
            throw new \Exception('invalidity message');

        $this->next($device);
    }
}
