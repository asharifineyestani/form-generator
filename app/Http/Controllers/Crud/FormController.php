<?php

namespace App\Http\Controllers\Crud;

use Afracode\CRUD\App\Controllers\CrudController;
use Afracode\Form\App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\User;
use Illuminate\Http\Request;

class FormController extends CrudController
{

    public function config()
    {
        $this->crud->setModel(Form::class);
        $this->crud->setEntity('forms');
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


        $this->crud->setField([
            'type' => 'relation',
            'method' => 'fields',
            'attribute' => 'title',
        ]);


//        $this->crud->setField([
//            'type' => 'vue-component',
//            'name' => 'field-table',
//        ]);


    }


    public function setupEdit()
    {
        $this->setupCreate();
    }


    public function view($id)
    {
        $field['name'] = 'form-view';
        return view('vue' , compact('field'));
    }
}
