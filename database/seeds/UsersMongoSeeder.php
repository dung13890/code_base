<?php

use Illuminate\Database\Seeder;
use App\Mongo\User;

class UsersMongoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            app(User::class)->create([
                'name' => 'system',
                'email' => 'system@example.com',
                'password' => bcrypt('secret'),
            ]);

            app(User::class)->create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('secret'),
            ]);
        }
    }
}
