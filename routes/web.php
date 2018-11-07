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
        ->rightJoin('RunRoute', 'Run_AutoID', '=' ,'RunRte_Run_AutoID')
        ->rightJoin('Route', 'Rte_AutoID', '=', 'RunRte_Rte_AutoID')
        ->whereIn('Run_Idx', $runList->toArray())
        ->orderBy('Rte_ID')
        ->orderBy('Run_ToFrom')
        ->get();

    dd($runs);

    $stop = DB::table('RunService')
        ->select('RunSrv_Run_AutoID', 'RunSrv_TimeAtSrv', 'Stop_Desc', 'RunSrv_Dh')
        ->join('StopService', 'StopSrv_AutoID', '=', 'RunSrv_StopSrv_AutoID')
        ->join('Stop', 'Stop_AutoID', '=', 'StopSrv_Stop_AutoID')
        ->whereIn('RunSrv_Run_AutoID', $runs->pluck('Run_AutoID')->toArray())
        ->orderBy('RunSrv_SeqNumber','asc')
        ->get();

    $stops = $stop->groupBy('RunSrv_Run_AutoID');

    dd($stops);

    foreach ($runs as $run) {
        $run->stop = DB::table('RunService')
            ->select('RunSrv_TimeAtSrv', 'Stop_Desc', 'RunSrv_Dh')
            ->join('StopService', 'StopSrv_AutoID', '=', 'RunSrv_StopSrv_AutoID')
            ->join('Stop', 'Stop_AutoID', '=', 'StopSrv_Stop_AutoID')
            ->where('RunSrv_Run_AutoID', '=', $run->Run_AutoID)
            ->orderBy('RunSrv_SeqNumber','asc')
            ->get();

//        $run->stop = \App\RunService::getStops($run);
    }



    return view('welcome')
        ->withRuns($runs);
});


