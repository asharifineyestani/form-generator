<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Crud routes
|--------------------------------------------------------------------------
|
*/
Route::group([
    'namespace'  => 'Ajax',
    'prefix'     => 'ajax',
], function ($router) {
    require base_path('routes/inc/ajax.php');
});


/*
|--------------------------------------------------------------------------
| form-generator
|--------------------------------------------------------------------------
|
*/
Route::group([
    'namespace'  => 'Form',
    'prefix'     => 'form-generator',
], function ($router) {
    require base_path('routes/inc/form-generator.php');
});

