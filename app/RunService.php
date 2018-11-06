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

}
