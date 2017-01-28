<?php

namespace Medusa\App;

use Illuminate\Database\Eloquent\Model;

class Hooks extends Model
{
    /**
     * Scope for enabled hooks
     * 
     * @param $query
     * @return mixed
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', '=', 1)
            ->get();
    }

    public function locations()
    {
        return $this->hasMany('\Medusa\App\HookLocations', 'hook_id', 'id');
    }
}
