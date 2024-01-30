<?php

namespace App\Services\Log\Update;
use App\Models\Log;
use App\Services\Log\Update\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function update(Log $log)
    {
        $validation_res = $this->validation_service->validate($log);
        return $validation_res;
    }

}
