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

    $runs = DB::table('Run')
        ->select('Run_AutoID', 'Run_Idx','Run_Desc', 'Rte_Desc', 'Rte_BusNumber', 'Rte_ID')
        ->join('RunRoute', 'Run_AutoID', '=' ,'RunRte_Run_AutoID')
        ->join('Route', 'Rte_AutoID', '=', 'RunRte_Rte_AutoID')
        ->whereIn('Run_Idx', $runList->toArray())
        ->orderBy('Rte_ID')
        ->orderBy('Run_ToFrom')
        ->get();

    $stop = DB::table('RunService')
        ->select('RunSrv_Run_AutoID', \DB::raw("FORMAT( RunSrv_TimeAtSrv, 'hh:mm tt') as DispTimeAtStop"), 'Stop_Desc', 'RunSrv_Dh')
        ->join('StopService', 'StopSrv_AutoID', '=', 'RunSrv_StopSrv_AutoID')
        ->join('Stop', 'Stop_AutoID', '=', 'StopSrv_Stop_AutoID')
        ->whereIn('RunSrv_Run_AutoID', $runs->pluck('Run_AutoID')->toArray())
        ->orderBy('RunSrv_TimeAtSrv','asc')
        ->groupBy('RunSrv_Run_AutoID', 'Stop_Desc', 'RunSrv_TimeAtSrv', 'RunSrv_Dh')
        ->get();

    $stops = $stop->groupBy('RunSrv_Run_AutoID');

    $runs->map( function ($item) use ($stops) {
        $stops->map( function ($s) use ($item) {
            if($s->first()->RunSrv_Run_AutoID == $item->Run_AutoID)
                return $item->Stops = $s;
        });
    });


    return view('welcome')
        ->withRuns($runs);
});


