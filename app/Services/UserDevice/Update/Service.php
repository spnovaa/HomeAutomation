<?php

namespace App\Services\UserDevice\Update;

use App\HelperClasses\Messages\ServiceMessage;
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
        if ($validation_res->isErrorType())
            return $validation_res;

        if ($device->isDirty()) {
            $old = UserDevices::find($device->UD_Id);
            unset($old->UD_Id);
            $old->update($device->getAttributes());
        }

        return ServiceMessage::Success('USER_DEVICE_UPDATED_SUCCESSFULLY');
    }

}
