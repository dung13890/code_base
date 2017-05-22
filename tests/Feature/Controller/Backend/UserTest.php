<?php

namespace Tests\Feature\Controller\Backend;

use Tests\TestCase;
use App\Eloquent\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreSuccess()
    {
        $user = $this->createUser();
        $this->actingAs($user, 'web');
        $data = factory(User::class)->make()->toArray();
        $data['password'] = 'secret';
        $data['password_confirmation'] = 'secret';
        $this->post(route('backend.user.store'), $data)->assertRedirect(route('backend.user.index'));
        $this->assertDatabaseHas('users', array_except($data, ['password', 'password_confirmation']));
    }

    public function testDeleteSuccess()
    {
        $user = $this->createUser();
        $this->actingAs($user, 'web');
        $data = factory(User::class)->create();
        $this->delete(route('backend.user.destroy', $data->id))->assertRedirect(route('backend.user.index'));
    }
}
