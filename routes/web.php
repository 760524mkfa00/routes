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


    $schools = \App\School::OrderBy('Sch_Name', 'Asc')->get();


    return view('schools')
        ->withSchools($schools);
});

Route::get('/runs/{id}', function ($id) {


    $runList = \App\RunService::select('RunSrv_Run_Idx')
        ->where('RunSrv_StopSrv_Idx', 'LIKE', "{$id}%")
        ->where('RunSrv_Dh', '=', '0')
        ->groupBy('RunSrv_Run_Idx')
        ->get();


    $runs = \App\Run::whereIn('Run_Idx', $runList->toArray())
        ->with('RunRoute', 'RunRoute.Route', 'RunService.StopService.Stop')
        ->get();

    $runs->map( function($item) {
       $item->Rte_Num = $item->RunRoute->RunRte_Rte_ID;
    });

    // Sort the collection based on a person's age.
    $sorted1 = $runs->sort(function($a, $b) {
        if ($a['Run_ToFrom'] == $b['Run_ToFrom']) {
            return 0;
        }

        return ($a['Run_ToFrom'] < $b['Run_ToFrom']) ? -1 : 1;
    });

    // Sort the collection based on a person's age.
    $sorted = $sorted1->sort(function($a, $b) {
        if ($a['Rte_Num'] == $b['Rte_Num']) {
            return 0;
        }

        return ($a['Rte_Num'] < $b['Rte_Num']) ? -1 : 1;
    });

    return view('welcome')
        ->withRuns($sorted);
});


