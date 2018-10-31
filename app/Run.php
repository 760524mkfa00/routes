<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    protected $table = "Run";

    public function RunService() {
        return $this->hasMany('App\RunService', 'RunSrv_Run_AutoID', 'Run_AutoID');
    }

    public function  RunRoute() {
        return $this->belongsTo('App\RunRoute','Run_AutoID', 'RunRte_Run_AutoID');
    }

}
