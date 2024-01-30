<?php

namespace App\Services\Device;
use App\Models\Device;
use App\Services\Device\Create\Service as CreateService;
use App\Services\Device\Delete\Service as DeleteService;
use App\Services\Device\Update\Service as UpdateService;
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

    public function create(Device $device)
    {
        return $this->create_service->create($device);
    }


    public function update(Device $device)
    {
        return $this->update_service->update($device);
    }


    public function delete(Device $device)
    {
        return $this->delete_service->delete($device);
    }

}
