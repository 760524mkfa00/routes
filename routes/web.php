<?php

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

Route::get('/', function () {

    $data = \App\Route::all();

    $runs = \App\Run::where('Run_Sch_Code', '051')->with('RunRoute.Route', 'RunService.StopService.Stop')->get();

//    dd($runs);

    return view('welcome')
        ->withRuns($runs);
});
