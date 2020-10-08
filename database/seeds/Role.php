<?php

use Illuminate\Database\Seeder;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Spatie\Permission\Models\Role::create([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);



        \App\User::find(1)->assignRole('super-admin');
    }
}
