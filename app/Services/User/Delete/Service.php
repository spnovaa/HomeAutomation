<?php

namespace App\Services\User\Delete;
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

    public function delete(User $user)
    {
        $validation_res = $this->validation_service->validate($user);
        if ($validation_res->isErrorType())
            return $validation_res;

        $user->delete();

        return ServiceMessage::Success('USER_DELETED_SUCCESSFULLY');
    }

}
