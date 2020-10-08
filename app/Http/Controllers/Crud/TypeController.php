<?php

namespace App\Http\Controllers\Crud;

use Afracode\CRUD\App\Controllers\CrudController;
use Afracode\Form\App\Models\Field;
use Afracode\Form\App\Models\Type;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;

class TypeController extends CrudController
{

    public function config()
    {
        $this->crud->setModel(Type::class);
        $this->crud->setEntity('types');
    }

    public function setupIndex()
    {
        $this->crud->setColumn('id');
        $this->crud->setColumn('title');
        $this->crud->setColumn('action');

    }

    public function setupCreate()
    {

        $this->crud->setField([
            'name' => 'title'
        ]);

    }


    public function setupEdit()
    {
        $this->setupCreate();
    }


}
