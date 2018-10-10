<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        DB::table('users')->delete();

        factory(\App\Models\User::class, 3)->create();

        factory(\App\Models\User::class, 1)->create([
            'first_name' => 'dammy',
            'last_name' => 'joel',
            'email' => 'dm@falive.com',
            'remember_token' => str_random(10),
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'
        ]);
    }
}
