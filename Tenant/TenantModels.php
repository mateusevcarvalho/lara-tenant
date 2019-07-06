<?php

namespace Modules\MultiTenant\Tenant;


use Modules\MultiTenant\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

trait TenantModels
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope());

        static::creating(function (Model $obj) {
            $tenant = MultiTenant::get();
            if ($tenant) {
                $obj->tenant_id = $tenant->id;
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}

//Category::all()
