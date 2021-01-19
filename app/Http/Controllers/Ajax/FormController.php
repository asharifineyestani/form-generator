<?php

namespace App\Http\Controllers\Ajax;

use Afracode\Form\App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function store(Request $request)
    {

        Form::create($request->all());
    }

    public function update(Request $request , $slug)
    {


        $fields = $request->except([
            'created_at' , 'id' , 'updated_at'
        ]);
        Form::where('slug' , $slug)->update($fields);
    }

    public function index(Request $request)
    {
        return Form::all();
    }


    public function show(  $form): Form
    {
        return Form::where('slug' , $form)->first();
    }



}
