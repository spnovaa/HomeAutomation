<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Services\User\Service as UserService;
use App\Traits\Controllers\ResourceControllerTrait;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    protected function getModelFromRequest(Request $request): Device
    {

    }

    public function register(Request $request)
    {
        
    }

    public function Login(Request $request)
    {
        
    }

    public function Logout(Request $request)
    {
        
    }

    use ResourceControllerTrait;
}
