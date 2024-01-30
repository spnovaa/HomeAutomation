<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Services\Log\Service as LogService;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    private $service;

    public function __construct(LogService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        try {

            $user_id = Auth::id();
            $list = $this->service->index($user_id);

            return response()->json(['list' => $list]);

        } catch (\Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage(),
                'code' => 'error',
            ], 500);
        }
    }


    public function show(int $id)
    {
        try {

            return response()->json(['log' => $this->service->getLog($id)]);

        } catch (\Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage(),
                'code' => 'error',
            ], 500);
        }
    }
}
