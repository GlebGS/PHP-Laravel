<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{

//    use RefreshDatabase;

    /** @test */

    public function registerUser(){

        $data = [
            'name' => 'Gleb',
            'email' => 'Gleb@mail.ru',
            'password' => bcrypt('secret'),
        ];

        User::register($data);

        $this->assertDatabaseHas('users', [
            'email' => 'Gleb@mail.ru',
        ]);

    }

    /** @test */

    public function registerUserId(){

        $this->assertDatabaseHas('users', [
            'id' => 1,
        ]);

        $data = [
            'user_id' => 1
        ];

        UserData::register($data);

        $this->assertDatabaseHas('user_data', [
            'user_id' => 1,
        ]);
    }

}
