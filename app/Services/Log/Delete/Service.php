<?php

namespace App\Services\Log\Delete;
use App\Models\Log;
use App\Services\Log\Delete\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function delete(Log $log)
    {
        $validation_res = $this->validation_service->validate($log);
        return $validation_res;
    }

}
