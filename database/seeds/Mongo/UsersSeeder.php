<?php

use Illuminate\Database\Seeder;
use App\Mongo\User;

class Mongo/UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            app(User::class)->find(1)->update([
                'name' => 'system',
                'email' => 'system@example.com',
                'password' => bcrypt('secret'),
            ]);

            app(User::class)->find(2)->update([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
