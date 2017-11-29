<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\MultiTenantScope;
use App\Scopes\ActiveScope;

class ServiceGroup extends Model
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

    public function incidents()
    {
        return $this->hasMany('\App\Incident', 'servicegroup_id');
    }

    public function services()
    {
        return $this->hasMany('\App\Service', 'servicegroup_id');
    }

}
