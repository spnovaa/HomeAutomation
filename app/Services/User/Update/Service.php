<?php

namespace App\Services\User\Update;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\User;
use App\Services\User\Delete\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function update(User $user)
    {
        $validation_res = $this->validation_service->validate($user);
        if ($validation_res->isErrorType())
            return $validation_res;

        //TODO: implementations e.g. using pipeline design pattern

        return ServiceMessage::Success('USER_UPDATED_SUCCESSFULLY');
    }

}
