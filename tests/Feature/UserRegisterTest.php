<?php

namespace Tests\Feature;


use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    public function test_user_can_register(): void
    {
        $user = [
            'name' => 'Mostafa',
            'lastName' => 'Rahmati',
            'username' => 'spnova',
            'password' => '123456',
        ];

        DB::beginTransaction();
        $res = $this->post('/users/register', $user);
        DB::rollBack();

        $res->assertJsonFragment([
            'code' => 'success',
        ]);
    }

    public function test_user_create_saves_proper_data(): void
    {
        $user = [
            'name' => 'Mostafa',
            'lastName' => 'Rahmati',
            'username' => 'spnova',
            'password' => '123456',
        ];

        DB::beginTransaction();
        $reg_res = $this->post('/users/register', $user);
        $get_res = $this->get('/users');
        DB::rollBack();

        $reg_res->assertJsonFragment([
            'code' => 'success',
        ]);

        $get_res->assertJsonFragment([
            'U_UsrName' => 'spnova',
            'U_Name' => 'Mostafa',
            'U_LName' => 'Rahmati'
        ]);
    }

}
