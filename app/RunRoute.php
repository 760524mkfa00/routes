<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RunRoute extends Model
{

    protected $table = "RunRoute";

    public function Route() {
        return $this->hasOne('App\Route', 'Rte_AutoID', 'RunRte_Rte_AutoID');
    }

}
