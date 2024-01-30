<?php

namespace App\Services\Device\Create;
use App\Models\Device;
use App\Services\Device\Create\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function create(Device $device)
    {
        $validation_res = $this->validation_service->validate($device);
    }

}
