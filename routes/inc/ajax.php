<?php

/*
|--------------------------------------------------------------------------
| Ready to use
|--------------------------------------------------------------------------
*/

Route::post('forms', 'FormController@store');
Route::post('answers', 'AnswerController@store');
Route::get('/forms/{slug}', 'FormController@show');
Route::put('/forms/{slug}', 'FormController@update');



