<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@afracode.com',
            'password' => bcrypt('password'),
        ]);

    }
}
