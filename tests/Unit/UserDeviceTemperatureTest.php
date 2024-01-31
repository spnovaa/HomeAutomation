<?php

namespace Tests\Unit;

use App\HelperClasses\Enums\DeviceType;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\Device;
use App\Models\User;
use App\Models\UserDevices;
use App\Services\Device\Create\Service as DeviceCreateService;
use App\Services\UserDevice\Service as UserDeviceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserDeviceTemperatureTest extends TestCase
{
    private $device_service;
    private $user_device_service;

    public function setUp(): void
    {
        parent::setUp();

        $this->device_service = $this->app->make(DeviceCreateService::class);
        $this->user_device_service = $this->app->make(UserDeviceService::class);
    }

    public function test_user_device_can_increase_valid_temperature()
    {
        try {
            DB::beginTransaction();

            $this->registerDummyUser();
            $user = User::orderBy('U_Id', 'desc')->first();
            Auth::login($user);

            $res = $this->createDummyDevice();
            $device_id = $res->getExtraInfo();
            $ud_id = $this->insertDummyUserDevice($device_id);

            $ud = UserDevices::find($ud_id);

            $this->user_device_service->increaseTemperature($ud, 10);

            //initial = 23. 23+10 = 33 < 80
            $is_33 = UserDevices::where('UD_Id', $ud_id)->value('UD_Temprature') == 33;
            $this->assertTrue($is_33);

            Auth::logout();
            DB::rollBack();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            dd($throwable);
        }
    }


    public function test_user_device_can_not_exceed_max_temperature()
    {
        try {
            DB::beginTransaction();

            $this->registerDummyUser();
            $user = User::orderBy('U_Id', 'desc')->first();
            Auth::login($user);

            $res = $this->createDummyDevice();
            $device_id = $res->getExtraInfo();
            $ud_id = $this->insertDummyUserDevice($device_id);

            $ud = UserDevices::find($ud_id);

            //initial = 23; 23+60 = 83 > 80
            $res = $this->user_device_service->increaseTemperature($ud, 60);

            $this->assertTrue($res->isErrorType());

            Auth::logout();
            DB::rollBack();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            dd($throwable);
        }
    }

    private function createDummyDevice()
    {
        $device = new Device([
            'D_Name' => 'Light No.1',
            'D_Model' => 'Sample Model 1',
            'D_Type' => DeviceType::LIGHT,
            'D_MinTemprature' => '0',
            'D_MaxTemprature' => '80',
            'D_MinBrightness' => '0',
            'D_MaxMinBrightness' => '100',
        ]);

        /**
         * @var $res ServiceMessage
         */
        return $this->device_service->create($device);

    }


    private function registerDummyUser()
    {
        $user = [
            'name' => 'Mostafa',
            'lastName' => 'Rahmati',
            'username' => 'spnova',
            'password' => '123456',
        ];

        $this->post('/users/register', $user);
    }

    private function insertDummyUserDevice($device_id)
    {

        $user_device = new UserDevices([
            'UD_UserId' => Auth::id(),
            'UD_DeviceId' => $device_id,
            'UD_IsOn' => false,
            'UD_Temprature' => '23',
            'UD_Brightness' => '10',
            'UD_CreatedAt' => now(),
            'UD_UpdatedAt' => now(),
        ]);

        /**
         * @var $res ServiceMessage
         */
        $res = $this->user_device_service->create($user_device);
        return$res->getExtraInfo();

    }

}
