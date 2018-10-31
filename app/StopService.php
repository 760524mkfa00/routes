<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StopService extends Model
{

    protected $table = "StopService";

    public function Stop() {
        return $this->hasOne('App\Stop', 'Stop_AutoID', 'StopSrv_Stop_AutoID');
    }

}
