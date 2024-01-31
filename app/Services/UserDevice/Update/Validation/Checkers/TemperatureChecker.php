<?php

namespace App\Services\UserDevice\Update\Validation\Checkers;

use App\Models\Device;
use App\Models\UserDevices;
use App\Services\UserDevice\Checker;
use Exception;

class TemperatureChecker extends Checker
{
    public function check($device)
    {
        $this->isTemperatureLessThanMax($device);
        $this->isTemperatureMoreThanMin($device);

        $this->next($device);
    }

    /**
     * @param UserDevices $user_device
     * @return void
     * @throws Exception
     */
    private function isTemperatureLessThanMax(UserDevices $user_device)
    {
        $max = Device::where('D_Id', $user_device->UD_DeviceId)->value('D_MaxTemprature');
        if ($user_device->UD_Temprature > $max)
            throw new Exception('USER_DEVICE_TEMPERATURE_OVERFLOW');
    }


    /**
     * @param UserDevices $user_device
     * @return void
     * @throws Exception
     */
    private function isTemperatureMoreThanMin(UserDevices $user_device)
    {
        $max = Device::where('D_Id', $user_device->UD_DeviceId)->value('D_MaxTemprature');
        if ($user_device->UD_Temprature > $max)
            throw new Exception('USER_DEVICE_TEMPERATURE_UNDERFLOW');
    }

}
