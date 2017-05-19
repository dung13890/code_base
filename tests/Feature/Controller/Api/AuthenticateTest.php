<?php

namespace Tests\Feature\Controller\Api;

use Tests\TestCase;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthenticateTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        \Artisan::call('passport:client', [
            '--password' => true,
            '--name' => 'api',
        ]);

        \DB::table('oauth_clients')->where('id', env('API_CLIENT_ID'))->update([
            'secret' => env('API_CLIENT_SECRET'),
        ]);
    }

    public function getHeader($header = [])
    {
        $default = [
            'Accept' => 'application/json',
        ];
        $headers = count($header) ? array_merge($default, $header) : $default;

        return $this->transformHeadersToServerVars($headers);
    }

    public function mockData()
    {
        $entity = factory(User::class)->make();

        return $entity->toArray();
    }

    public function testLoginFail()
    {
        $data = $this->mockData();
        $headers = $this->getHeader();
        $response = $this->call('POST', route('api.v1.login'), $data, [], [], $headers);

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

    public function tesLoginSuccess()
    {
        $data = app(User::class)->find(1, ['email'])->toArray();
        $data['password'] = 'secret';
        $response = $this->call('POST', route('api.v1.login'), $data, [], [], $this->getHeader());
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
    }
}
