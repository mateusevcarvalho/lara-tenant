<?php

namespace Modules\MultiTenant\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
