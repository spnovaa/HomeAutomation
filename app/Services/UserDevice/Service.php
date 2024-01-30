<?php

namespace App\Services\UserDevice;
use App\Models\UserDevices;
use App\Services\UserDevice\Create\Service as CreateService;
use App\Services\UserDevice\Delete\Service as DeleteService;
use App\Services\UserDevice\Update\Service as UpdateService;
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

    public function create(UserDevices $device)
    {
        return $this->create_service->create($device);
    }


    public function update(UserDevices $device)
    {
        return $this->update_service->update($device);
    }


    public function delete(UserDevices $device)
    {
        return $this->delete_service->delete($device);
    }


    public function turn(UserDevices $device, bool $on)
    {
        $device->UD_IsOn = $on;
        return $this->update($device);
    }


    public function increaseTemperature(UserDevices $device, float $amount)
    {
        $device->UD_Temprature += $amount;
        return $this->update($device);
    }

    public function decreaseTemperature(UserDevices $device, float $amount)
    {
        $device->UD_Temprature -= $amount;
        return $this->update($device);
    }

    public function increaseLight(UserDevices $device, float $amount)
    {
        $device->UD_Brightness += $amount;
        return $this->update($device);
    }

    public function decreaseLight(UserDevices $device, float $amount)
    {
        $device->UD_Brightness -= $amount;
        return $this->update($device);
    }


}
