<?php

namespace Tests\Feature\Controller\Api;

use Tests\TestCase;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
    }

    public function testIndexWithoutOwner()
    {
        $headers = $this->getHeader();
        $response = $this->call('GET', route('api.v1.users.index'), [], [], [], $headers);
        $response->assertJsonStructure([
            'message' => [
                'status', 'code', 'description'
            ]
        ])->assertJson([
            'message' => [
                'status' => false,
                'code' => 401,
            ]
        ]);
    }

    public function testIndexSuccess()
    {
        $user = $this->createUser();
        $this->actingAs($user, 'api');
        $headers = $this->getHeader();
        $response = $this->call('GET', route('api.v1.users.index'), [], [], [], $headers);
        $response->assertJsonStructure([
            'message' => [
                'status', 'code',
            ],
            'items'
        ])->assertJson([
            'message' => [
                'status' => true,
                'code' => 200,
            ]
        ])->assertStatus(200);
    }

    public function testStoreWithoutParams()
    {
        $user = $this->createUser();
        $this->actingAs($user, 'api');
        $headers = $this->getHeader();
        $response = $this->call('POST', route('api.v1.users.store'), [], [], [], $headers);

        $response->assertJsonStructure([
            'message' => [
                'status', 'code', 'description'
            ]
        ])->assertJson([
            'message' => [
                'status' => false,
                'code' => 422,
            ]
        ]);
    }

    public function testStoreSuccess()
    {
        $user = $this->createUser();
        $this->actingAs($user, 'api');
        $headers = $this->getHeader();

        $data = factory(User::class)->make()->toArray();
        $data['password'] = 'secret';
        $data['password_confirmation'] = 'secret';
        $response = $this->call('POST', route('api.v1.users.store'), $data, [], [], $headers);

        $response->assertJsonStructure([
            'message' => [
                'status', 'code',
            ],
        ])->assertJson([
            'message' => [
                'status' => true,
                'code' => 200,
            ]
        ])->assertStatus(200);

        $this->assertDatabaseHas('users', array_except($data, ['password', 'password_confirmation']));
    }
}
