<?php

namespace Tests\Feature\Api\RimoTatsu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->withoutmiddleware()->get('api/rimo-tatsu/task', []);
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => 1
                 ]);
    }
}
