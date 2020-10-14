<?php

/*
|--------------------------------------------------------------------------
| Ready to use
|--------------------------------------------------------------------------
*/


Route::resource('menu', 'MenuController');
Route::resource('languages', 'LanguageController');



Route::resource('forms', 'FormController');
Route::get('forms/{id}/view', 'FormController@view');
Route::get('forms/{id}/fields', 'FormController@fields');
Route::resource('fields', 'FieldController');
Route::resource('options', 'OptionController');
Route::resource('types', 'TypeController');
Route::resource('languages', 'LanguageController');
