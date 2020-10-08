<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Type::class);
        $this->call(Menu::class);
        $this->call(User::class);
        $this->call(Role::class);
    }
}
