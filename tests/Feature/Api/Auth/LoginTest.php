<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {

        // テストログイン用のユーザー作成
        $email = 'testadmin@example.com';
        $password = '12345678';
        User::where('email', $email)->delete();
        User::create([
            'name' => 'TestAdmin',
            'email' => $email,
            'password' => bcrypt($password),
            'role_id' => 1,
        ]);

        // ログインしていないことを確認
        $this->assertFalse(Auth::check(), 'unexpected: User already logged-in');

        // ログインリクエスト
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Referer' => env('APP_URL'),
        ])->json('POST', 'api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        // ログインしているか確認
        $this->assertTrue(Auth::check(), 'Login failed');
        $response->assertStatus(200);

    }
}
