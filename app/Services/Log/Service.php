<?php

namespace App\Services\Log;

use App\Models\Log;
use App\Services\Log\Create\Service as CreateService;
use App\Services\Log\Delete\Service as DeleteService;
use App\Services\Log\Update\Service as UpdateService;

class Service
{
    private $create_service;
    private $delete_service;
    private $update_service;


    public function __construct(CreateService $c_s, DeleteService $d_s, UpdateService $u_s)
    {
        $this->create_service = $c_s;
        $this->delete_service = $d_s;
        $this->update_service = $u_s;
    }


    public function create(Log $log)
    {
        return $this->create_service->create($log);
    }


    public function delete(Log $log)
    {
        return $this->delete_service->delete($log);
    }


    public function update(Log $log)
    {
        return $this->update_service->update($log);
    }


    public function saveLog($action, $section, $amount)
    {
        $log = new Log([
            'L_Action' => $action,
            'L_Section' => $section,
            'L_Amount' => $amount,
            'L_Ip' => request()->ip(),

            'L_CreatedAt' => now(),
            'L_UpdatedAt' => now(),
        ]);

        return $this->create($log);
    }
}
