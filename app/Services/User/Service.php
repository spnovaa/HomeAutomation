<?php

namespace App\Services\User;
use App\Models\User;
use App\Services\User\Create\Service as CreateService;
use App\Services\User\Delete\Service as DeleteService;
use App\Services\User\Update\Service as UpdateService;

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

    public function create(User $user)
    {
        $res = $this->create_service->create($user);

        return $res;

    }

    public function delete(User $user)
    {
        $res = $this->delete_service->delete($user);

        return $res;

    }

    public function update(User $user)
    {
        $res = $this->update_service->update($user);

        return $res;

    }

    public function index()
    {
        return User::all();

    }

    public function show($id)
    {
        return User::where('U_Id', $id)->with('account')->first();
    }

}
