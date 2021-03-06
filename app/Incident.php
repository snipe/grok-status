<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\MultiTenantScope;
use App\Scopes\ActiveScope;

class Incident extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MultiTenantScope);
        static::addGlobalScope(new ActiveScope);
    }


    public function account()
    {
        return $this->belongsTo('\App\Account', 'account_id');
    }


}
