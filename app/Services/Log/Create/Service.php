<?php

namespace App\Services\Log\Create;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\Log;
use App\Services\Log\Create\Validation\Service as ValidationService;
class Service
{
    private $validation_service;
    public function __construct(ValidationService $validation_service)
    {
        $this->validation_service = $validation_service;
    }

    public function create(Log $log)
    {
        $validation_res = $this->validation_service->validate($log);
        if ($validation_res->isSuccessType())
        {
            $log->save();
            return ServiceMessage::Success('LOG_STORED_SUCCESSFULLY');
        }
        else
            return $validation_res;
    }

}
