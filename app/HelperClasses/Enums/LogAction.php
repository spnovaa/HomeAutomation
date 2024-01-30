<?php

namespace App\HelperClasses\Enums;

abstract class LogAction
{
    const CREATE = 1;
    const READ = 2;
    const UPDATE = 3;
    const DELETE = 4;
    const REPORT = 5;
}
