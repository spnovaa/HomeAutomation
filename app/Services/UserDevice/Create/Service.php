<?php

namespace App\Services\UserDevice\Create;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\UserDevices;
use App\Services\UserDevice\Create\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function create(UserDevices $device)
    {
        $validation_res = $this->validation_service->validate($device);
        if ($validation_res->isErrorType())
            return $validation_res;

        UserDevices::create($device->getAttributes());

        return ServiceMessage::Success('USER_DEVICE_CREATED_SUCCESSFULLY');
    }

}
