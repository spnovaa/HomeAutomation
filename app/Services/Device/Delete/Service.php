<?php

namespace App\Services\Device\Delete;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\Device;
use App\Services\Device\Delete\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function delete(Device $device)
    {
        $validation_res = $this->validation_service->validate($device);
        if ($validation_res->isErrorType())
            return $validation_res;

        $device->delete();

        return ServiceMessage::Success('DEVICE_DELETED_SUCCESSFULLY');
    }

}
