<?php

namespace App\Services\Device\Update;

use App\HelperClasses\Messages\ServiceMessage;
use App\Models\Device;
use App\Services\Device\Update\Validation\Service as ValidationService;

class Service
{
    private $validation_service;

    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function update(Device $device)
    {
        $validation_res = $this->validation_service->validate($device);
        if ($validation_res->isErrorType())
            return $validation_res;

        if ($device->isDirty()) {
            $old = Device::find($device->D_Id);
            unset($old->D_Id);
            $old->update($device->getAttributes());
        }

        return ServiceMessage::Success('DEVICE_UPDATED_SUCCESSFULLY');
    }

}
