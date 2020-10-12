<?php

namespace App\Http\Controllers\Form;

use Afracode\Form\App\Models\Form;
use Afracode\Form\App\Models\Type;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    //

    public function index()
    {
        $data['forms'] = Form::all();
        $data['fieldTypes'] = Type::all();

        return $data;

    }
}
