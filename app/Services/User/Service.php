<?php

namespace App\Services\User;
use App\Models\User;
use App\Services\User\Create\Service as CreateService;
use App\Services\User\Delete\Service as DeleteService;
use App\Services\User\Update\Service as UpdateService;
use App\Services\Log\Service as LogService;

class Service
{
    private $create_service;
    private $delete_service;
    private $update_service;
    private $log_service;


    public function __construct(CreateService $c_s, DeleteService $d_s, UpdateService $u_s, LogService $l_s)
    {
        $this->create_service = $c_s;
        $this->delete_service = $d_s;
        $this->update_service = $u_s;
        $this->log_service = $l_s;
    }

    public function create(User $user)
    {
        $res = $this->create_service->create($user);
        if ($res->isSuccessType())
            $this->log_service->saveLog('ایجاد یوزر');

        return $res;

    }

    public function delete(User $user)
    {
        $res = $this->delete_service->delete($user);
        if ($res->isSuccessType())
            $this->log_service->saveLog('حذف یوزر');

        return $res;

    }

    public function update(User $user)
    {
        $res = $this->update_service->delete($user);
        if ($res->isSuccessType())
            $this->log_service->saveLog('ویرایش یوزر');

        return $res;

    }

}
