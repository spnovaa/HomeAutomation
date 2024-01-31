<?php

namespace Tests\Unit;


use App\HelperClasses\Enums\DeviceType;
use App\Models\Device;
use App\Services\Device\Create\Service as CreateService;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DeviceCreateTest extends TestCase
{
    private $service;
    public function setUp(): void
    {
        parent::setUp();

        $this->service = $this->app->make(CreateService::class);
    }

    public function test_device_create_method_works_fine()
    {
        DB::beginTransaction();

        $device = new Device([
            'D_Name' => 'Light No.1',
            'D_Model' => 'Sample Model 1',
            'D_Type' => DeviceType::LIGHT,
            'D_MinTemprature' => '0',
            'D_MaxTemprature' => '80',
            'D_MinBrightness' => '0',
            'D_MaxMinBrightness' => '100',
        ]);

        $res = $this->service->create($device);
        $this->assertTrue($res->isSuccessType());

        DB::rollBack();
    }
}
