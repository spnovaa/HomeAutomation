<?php

namespace App\Traits\Controllers;

use App\HelperClasses\Messages\ServiceMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

trait ResourceControllerTrait
{

    public function index()
    {
        $list = $this->service->index();
        return response()->json($list);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $model = $this->getModelFromRequest($request);
            /**
             * @var $res ServiceMessage
             */
            $res = $this->service->store($model);

            if ($res->isErrorType()) {
                DB::rollBack();
                return response()->json([
                    'message' => $res->getMessage(),
                    'status' => 'error'
                ], 400);
            }

            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            return response()->json([
                'message' => 'خطای داخلی'
            ], 500);
        }

        return response()->json([
            'message' => $res->getExtraInfo(),
            'status' => 'success'
        ]);
    }


    public function show(string $gen_id)
    {
        $factor_data = $this->service->show($gen_id);

        return response()->json($factor_data);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $model = $this->getModelFromRequest($request);
            /**
             * @var $res ServiceMessage
             */
            $res = $this->service->update($model);

            if ($res->isErrorType()){
                DB::rollBack();
                return response()->json([
                    'status' =>'error',
                    'message' => $res->getMessage()
                ], 406);
            }
            DB::commit();

        } catch (Throwable $throwable) {
            return response()->json([
                'status' =>'error',
                'message' => 'خطای داخلی'
            ], 500);
        }

        return response()->json([
            'message' => $res->getExtraInfo(),
            'status' => 'success'
        ]);
    }



    public function destroy($id)
    {
        $model = $this->service->getModel($id);
        $res = $this->service->delete($model);

        return response()->json($res, $this->getResultCode($res));
    }


    /**
     * @param $res
     * @return int
     */
    private function getResultCode($res): int
    {
        if ($res instanceof ServiceMessage && $res->isErrorType()) return 500;
        else return 200;
    }


}
