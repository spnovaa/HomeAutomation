<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use App\Services\User\Service as UserService;
use App\Traits\Controllers\ResourceControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    #-------------------------------------------------------------------------------------------------------------------
    // for now, to prevent middleware implementations for this project,
    // we put the registration and authentication methods here.
    public function register(Request $request)
    {
        $user = new User([
            'U_Name' => $request['name'],
            'U_LName' => $request['lastName'],
            'U_UsrName' => $request['username'],
            'U_Password' => hash('sha256', $request['password'])
        ]);

        $res = $this->service->create($user);

        if ($res->isSuccesssType())
        {
            Auth::login($user);
            return response()->json([
                'message' => 'ثبت نام با موفقیت انجام شد',
                'code' => 'success'
            ], 200);
        }

        return response()->json([
            'message' => $res->getMessage(),
            'code' => 'error'
        ], 406);
    }

    public function Login(Request $request)
    {

    }

    public function Logout(Request $request)
    {

    }

    use ResourceControllerTrait;
}
