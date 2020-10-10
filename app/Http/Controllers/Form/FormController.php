<?php

namespace App\Http\Controllers\Form;

use Afracode\Form\App\Models\Form;
use Afracode\Form\App\Models\Type;
use App\Http\Controllers\Controller;
use App\Http\Resources\FormResource;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index(Request $request)
    {
        $query = Form::query();

        foreach ($request->get('filters') ?? [] as $key => $value)
            $query = $query->where($key , $value);

        return $query->get();
    }


    public function show(Request $request , $id)
    {
        $query = Form::where('id' , $id);

        $query = $query->with('fields.options');


//        return $query->first();
        return new FormResource($query->first());
    }
}
