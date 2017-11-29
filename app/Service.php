<?php

namespace App;

use App\Scopes\ActiveScope;
use App\Scopes\MultiTenantScope;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
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
        static::addGlobalScope(new ActiveScope());
    }

}
