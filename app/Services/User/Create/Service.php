<?php

namespace App\Services\User\Create;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\User;
use App\Services\User\Create\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function create(User $user)
    {
        $validation_res = $this->validation_service->validate($user);
        if ($validation_res->isErrorType())
            return $validation_res;

        unset($user['U_Id']);
        User::create($user->getAttributes());
        $id = User::where('U_UsrName', $user['U_UsrName'])->value('U_Id');

        $res = ServiceMessage::Success('USER_CREATED_SUCCESSFULLY');
        $res->setExtraInfo($id);

        return $res;
    }

}
