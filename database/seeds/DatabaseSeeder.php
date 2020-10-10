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


        $field1 = \Afracode\Form\App\Models\Field::create([
            'title' => 'نوع چوب',
            'type_id' => 6
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'گردو',
            'field_id' => 1,
            'price' => 21000 ,
            'media_path' => '/uploads/choob1.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'عناب',
            'field_id' => 1,
            'price' => 15000 ,
            'media_path' => '/uploads/choob2.jpg',
        ]);


        \Afracode\Form\App\Models\Option::create([
            'title' => 'اقاقیا',
            'field_id' => 1,
            'price' => 17000 ,
            'media_path' => '/uploads/choob3.jpg',
        ]);



        \Afracode\Form\App\Models\Option::create([
            'title' => 'گلابی',
            'field_id' => 1,
            'price' => 32000 ,
            'media_path' => '/uploads/choob4.jpg',
        ]);



        \Afracode\Form\App\Models\Option::create([
            'title' => 'افرا',
            'field_id' => 1,
            'price' => 29000 ,
            'media_path' => '/uploads/choob5.jpg',
        ]);



        \Afracode\Form\App\Models\Option::create([
            'title' => 'ممرز',
            'field_id' => 1,
            'price' => 25000 ,
            'media_path' => '/uploads/choob6.jpg',
        ]);



        \Afracode\Form\App\Models\Option::create([
            'title' => 'گردو',
            'field_id' => 1,
            'price' => 20000 ,
            'media_path' => '/uploads/choob7.jpg',
        ]);


        $field2 = \Afracode\Form\App\Models\Field::create([
            'title' => 'پوشش',
            'type_id' => 1
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مات',
            'field_id' => 2,
            'price' => 0 ,
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'براق',
            'field_id' => 2,
            'price' => 0 ,
        ]);

        \Afracode\Form\App\Models\Field::create([
            'title' => 'سایز',
            'type_id' => 3,

        ]);

        \Afracode\Form\App\Models\Field::create([
            'title' => 'array-string',
            'type_id' => 4
        ]);

        \Afracode\Form\App\Models\Field::create([
            'title' => 'boolean',
            'type_id' => 5
        ]);

       $field6 =  \Afracode\Form\App\Models\Field::create([
            'title' => 'مهره',
            'type_id' => 7
        ]);



        \Afracode\Form\App\Models\Field::create([
            'title' => 'بند',
            'type_id' => 6
        ]);



        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره عقیق',
            'field_id' => 6,
            'price' => 100,
            'media_path' => '/uploads/mohre1.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره سیاه',
            'field_id' => 6,
            'price' => 250 ,
            'media_path' => '/uploads/mohre2.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'آبی رگه دار',
            'field_id' => 6,
            'price' => 300,
            'media_path' => '/uploads/mohre3.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره چوبی',
            'field_id' => 6,
            'price' => 50,
            'media_path' => '/uploads/mohre4.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره سنگی',
            'field_id' => 6,
            'price' => 450,
            'media_path' => '/uploads/mohre5.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره یشمی',
            'field_id' => 6,
            'price' => 1400,
            'media_path' => '/uploads/mohre6.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره مروارید',
            'field_id' => 6,
            'price' => 2000,
            'media_path' => '/uploads/mohre7.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره بنقش',
            'field_id' => 6,
            'price' => 2000,
            'media_path' => '/uploads/mohre8.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'مهره رنگی',
            'field_id' => 6,
            'price' => 2000,
            'media_path' => '/uploads/mohre9.jpg',
        ]);






        \Afracode\Form\App\Models\Option::create([
            'title' => 'بند سواروسکی بنفش',
            'field_id' => 7,
            'price' => 9500,
            'media_path' => '/uploads/band1.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'بند سواروسکی آبی',
            'field_id' => 7,
            'price' => 8500 ,
            'media_path' => '/uploads/band2.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'آبی رگه دار',
            'field_id' => 7,
            'price' => 7500,
            'media_path' => '/uploads/band3.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'بند چوبی',
            'field_id' => 7,
            'price' => 8900,
            'media_path' => '/uploads/band4.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'زنجیر',
            'field_id' => 7,
            'price' => 7100,
            'media_path' => '/uploads/band5.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'بند چرمی',
            'field_id' => 7,
            'price' => 7600,
            'media_path' => '/uploads/band6.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'بند سیاه',
            'field_id' => 7,
            'price' => 6000,
            'media_path' => '/uploads/band7.jpg',
        ]);

        \Afracode\Form\App\Models\Option::create([
            'title' => 'بند بنقش',
            'field_id' => 7,
            'price' => 6500,
            'media_path' => '/uploads/band8.jpg',
        ]);


        $form = \Afracode\Form\App\Models\Form::create([
            'title' => 'form1'
        ]);


        $field1 = \Afracode\Form\App\Models\Field::create([
            'title' => 'تصویر',
            'type_id' => 8
        ]);

        $form->fields()->attach([1 => ['col' => 6]]);
        $form->fields()->attach([2 => ['col' => 6]]);
        $form->fields()->attach([3 => ['col' => 12]]);
        $form->fields()->attach([4 => ['col' => 12]]);
        $form->fields()->attach([5 => ['col' => 12]]);
        $form->fields()->attach([6 => ['col' => 12]]);
        $form->fields()->attach([7 => ['col' => 12]]);
        $form->fields()->attach([8 => ['col' => 12]]);


    }
}
