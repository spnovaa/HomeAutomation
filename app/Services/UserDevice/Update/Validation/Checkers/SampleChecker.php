<?php

namespace App\Services\UserDevice\Update\Validation\Checkers;

use App\Services\UserDevice\Checker;

class SampleChecker extends Checker
{
    public function check($obj)
    {
        // sample checker. The real checking process may be implemented here.
        if (false)
            throw new \Exception('invalidity message');

        $this->next($obj);
    }
}
