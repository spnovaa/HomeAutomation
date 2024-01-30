<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
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

    protected function getModelFromRequest(Request $request): User
    {
        return new User([
            'U_Id' => $request['id'],
            'U_Name' => $request['name'],
            'U_LName' => $request['lastName'],
            'U_UsrName' => $request['username'],
            'U_Password' => hash('sha256', $request['password'])
        ]);
    }

    #-------------------------------------------------------------------------------------------------------------------
    // for now, to prevent middleware implementations for this project,
    // we put the registration and authentication methods here.
    public function register(Request $request)
    {
        $user = $this->getModelFromRequest($request);

        $res = $this->service->create($user);

        if ($res->isSuccessType()) {
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

    // for now, to prevent middleware implementations for this project(that is not required),
    // we put the registration and authentication methods simply here. they would be developed soon
    public function Login(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $user = User::where([
            'U_Username' => $username,
            'U_Password' => hash('sha256', $password)
        ])->first();

        if ($user) {
            Auth::login($user);
            return response()->json([
                'message' => 'ورود با موفقیت انجام شد',
                'code' => 'success'
            ], 200);
        }

        return response()->json([
            'message' => 'اطلاعات کاربری صحیح نیست',
            'code' => 'error'
        ], 406);
    }

    // for now, to prevent middleware implementations for this project(that is not required),
    // we put the registration and authentication methods simply here. they would be developed soon
    public function Logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'message' => 'خروج با موفقیت انجام شد',
            'code' => 'success'
        ], 200);
    }

    use ResourceControllerTrait;
}
