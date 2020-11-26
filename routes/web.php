<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('inicio','/');
Route::get('/', function () {
    return view('layouts.ticket');
});
Route::post('ajax/tickets/crear','App\Http\Controllers\TicketController@ajaxTicketCreate');
Route::post('ajax/tickets/buscar','App\Http\Controllers\TicketController@ajaxTicketSearch');


/*=============================
=            Redireccion           =
=============================*/

Route::get('/{any}', function ($any) {

return redirect('/');

})->where('any', '.*');