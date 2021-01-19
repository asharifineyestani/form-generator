<?php

namespace App\Http\Controllers\Ajax;

use Afracode\Form\App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function store(Request $request)
    {

        Answer::create($request->all());
    }





}
