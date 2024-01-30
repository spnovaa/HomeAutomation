<?php

namespace App\Http\Controllers\Devices;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Services\Device\Service as DeviceService;
use App\Traits\Controllers\ResourceControllerTrait;
use Illuminate\Http\Request;

class OvensController extends Controller
{
    private $service;

    public function __construct(DeviceService $service)
    {
        $this->service = $service;
    }

    protected function getModelFromRequest(Request $request): Device
    {

    }

    public function turn(Request $request)
    {

    }

    public function decrease(Request $request)
    {

    }

    use ResourceControllerTrait;
}
