<?php

use Illuminate\Database\Seeder;

class Menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $items = [

            [
                "icon" => "fa-tasks",
                "name" => "menu",
                "href" => "menu",
                "permission" => "menu-read",
            ],

            [
                "icon" => "fa-tasks",
                "name" => "forms",
                "href" => "forms",
                "permission" => "forms-read",
            ],


            [
                "icon" => "fa-tasks",
                "name" => "fields",
                "href" => "fields",
                "permission" => "fields-read",
            ],


        ];


        foreach ($items as $item)
            \Afracode\CRUD\App\Models\Menu::create($item);
    }
}
