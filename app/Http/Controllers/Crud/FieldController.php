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

class FieldController extends CrudController
{

    public function config()
    {
        $this->crud->setModel(Field::class);
        $this->crud->setEntity('fields');
    }

    public function setupIndex()
    {
        $this->crud->setColumn('id');
        $this->crud->setColumn('title');
        $this->crud->setColumn('type_id');
        $this->crud->setColumn('action');

    }

    public function setupCreate()
    {

        $this->crud->setField([
            'name' => 'title'
        ]);


        $this->crud->setField([
            'name' => 'type_id',
            'type' => 'select2',
            'options' => queryAdaptToSelect(Type::all() , 'title'),
        ]);

        $this->crud->setField([
            'name' => 'options-table',
            'type' => 'vue-component',
        ]);

    }


    public function setupEdit()
    {
        $this->setupCreate();
    }


    public function show($id)
    {
        $query = Attribute::where('id', $id)->with('options')->first();
        return $query;
    }
}
