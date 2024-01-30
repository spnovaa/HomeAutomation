<?php

namespace App\Services\User\Create;
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
    }

}
