<?php

namespace Tests\Feature\Api\RimoTatsu;

use Tests\TestCase;
use App\Models\Vote;
use App\Models\User;
use App\Models\Achievement;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AchievementPostTest extends TestCase
{

    private $user;
    private $vote;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->prepareUser();

        // 不正なタスクID
        $this->withoutmiddleware()->post('api/rimo-tatsu/achievement', [
            'task_ids' => [1, 2, 10000]
        ])->assertStatus(400, 'Task-id check does not work');


        // 成功するケース
        $this->withoutmiddleware()->post('api/rimo-tatsu/achievement', [
            'task_ids' => Task::inRandomOrder()->take(10)->pluck('id')->toArray()
        ])->assertStatus(200, 'Vote function does not work properly');


        // 既に宝くじに参加している場合、400を返す
        $this->prepareVote();
        $this->withoutmiddleware()->post('api/rimo-tatsu/achievement', [
            'task_ids' => [1, 2]
        ])->assertStatus(400, 'Votablity check does not work');

        $this->cleanup();
    }

    /**
     * テスト用のユーザーを準備
     * 
     * 新しいユーザーを作成して、ログインした状態にする
     */
    public function prepareUser()
    {
        $email = 'testadmin@example.com';
        $password = '12345678';
        // テストログイン用のユーザー作成
        User::where('email', $email)->delete();
        $this->user = User::create([
            'name' => 'TestAdmin',
            'email' => $email,
            'password' => bcrypt($password),
            'role_id' => 1,
        ]);
        // ユーザーのログイン
        Auth::attempt(['email' => $email, 'password' => $password]);
    }

    /**
     * 新しい投票を作成する
     */
    public function prepareVote()
    {
        $this->vote = Vote::create([
            'user_id' => $this->user->id,
            'answer' => 2,
        ]);
    }

    /**
     * 後片付けをする
     * 
     * ユーザーをログアウトさせ、そのユーザーの投票、達成タスク、ユーザー自体を削除する
     */
    public function cleanup()
    {
        Auth::logout();
        Vote::find($this->vote->id)->delete();
        Achievement::where('user_id', $this->user->id)->delete();
        User::find($this->user->id)->delete();
    }
}
