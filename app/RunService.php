<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RunService extends Model
{

    protected $table = "RunService";

    protected $dates = ['RunSrv_TimeAtSrv', 'RunSrv_BeginDate', 'RunSrv_EndDate', 'RunSrv_TimeChanged'];

    public function StopService() {
        return $this->hasOne('App\StopService', 'StopSrv_AutoID', 'RunSrv_StopSrv_AutoID');
    }

    Static public function getStops($run) {
            return RunService::select('RunSrv_TimeAtSrv', 'Stop_Desc', 'RunSrv_Dh')
            ->join('StopService', 'StopSrv_AutoID', '=', 'RunSrv_StopSrv_AutoID')
            ->join('Stop', 'Stop_AutoID', '=', 'StopSrv_Stop_AutoID')
            ->where('RunSrv_Run_AutoID', '=', $run->Run_AutoID)
            ->orderBy('RunSrv_SeqNumber','asc')
            ->get();
    }

}
