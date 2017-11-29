<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function owner()
    {
        return $this->belongsTo('\App\User', 'owner_id');
    }

    public function incidents()
    {
        return $this->hasMany('\App\Incident', 'account_id');
    }

    public function setHomeUrlAttribute($key, $value)
    {

    }


}
