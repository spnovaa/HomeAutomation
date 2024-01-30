<?php

namespace App\Services\UserDevice\Delete;
use App\Models\UserDevices;
use App\Services\UserDevice\Delete\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function delete(UserDevices $device)
    {
        $validation_res = $this->validation_service->validate($device);
    }

}
