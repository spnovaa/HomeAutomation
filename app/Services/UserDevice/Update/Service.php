<?php

namespace App\Services\UserDevice\Update;

use App\Models\UserDevices;
use App\Services\UserDevice\Update\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function update(UserDevices $device)
    {
        $validation_res = $this->validation_service->validate($device);
    }

}
