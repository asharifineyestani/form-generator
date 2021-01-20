<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    //

    public function show($id)
    {
        $query = Answer::find($id);


        return view('answers.show' , compact('query'));
    }
}
