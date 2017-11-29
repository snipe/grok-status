<?php

namespace App;

use Spatie\UptimeMonitor\Models\Monitor;
use App\Scopes\MultiTenantScope;
use App\Scopes\ActiveScope;

class Monitor extends Spatie\UptimeMonitor\Models\Monitor
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


}
