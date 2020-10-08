<?php

use Illuminate\Database\Seeder;

class Type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

       \Afracode\Form\App\Models\Type::create([
            'title' => 'select',
        ]);

        \Afracode\Form\App\Models\Type::create([
            'title' => 'multiple-select',
        ]);

        \Afracode\Form\App\Models\Type::create([
            'title' => 'string',
        ]);

        \Afracode\Form\App\Models\Type::create([
            'title' => 'array-string',
        ]);

        \Afracode\Form\App\Models\Type::create([
            'title' => 'boolean',
        ]);
    }
}
