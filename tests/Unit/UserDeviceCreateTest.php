<?php

namespace Tests\Unit;

use App\HelperClasses\Enums\DeviceType;
use App\HelperClasses\Messages\ServiceMessage;
use App\Models\Device;
use App\Models\User;
use App\Models\UserDevices;
use App\Services\Device\Create\Service as DeviceCreateService;
use App\Services\UserDevice\Create\Service as UserDeviceCreateService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserDeviceCreateTest extends TestCase
{
    private $device_service;
    private $user_device_service;

    public function setUp(): void
    {
        parent::setUp();

        $this->device_service = $this->app->make(DeviceCreateService::class);
        $this->user_device_service = $this->app->make(UserDeviceCreateService::class);
    }

    public function test_user_device_can_be_created()
    {
        try {
            DB::beginTransaction();

            $this->registerDummyUser();
            $res = $this->createDummyDevice();
            $device_id = $res->getExtraInfo();
            $this->assertTrue($res->isSuccessType());

            $user = User::orderBy('U_Id', 'desc')->first();
            Auth::login($user);

            $user_device = new UserDevices([
                'UD_UserId' => Auth::id(),
                'UD_DeviceId' => $device_id,
                'UD_IsOn' => true,
                'UD_Temprature' => '23',
                'UD_Brightness' => '10',
                'UD_CreatedAt' => now(),
                'UD_UpdatedAt' => now(),
            ]);

            /**
             * @var $res ServiceMessage
             */
            $res = $this->user_device_service->create($user_device);
            $this->assertTrue($res->isSuccessType());

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


    public function registerDummyUser()
    {
        $user = [
            'name' => 'Mostafa',
            'lastName' => 'Rahmati',
            'username' => 'spnova',
            'password' => '123456',
        ];

        $this->post('/users/register', $user);
    }
}
