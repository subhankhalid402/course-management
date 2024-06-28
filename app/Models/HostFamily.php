<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostFamily extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function airport()
    {
        return $this->belongsTo(Airport::class, 'airport_id', 'id');
    }

    public function local_coordinator()
    {
        return $this->belongsTo(LocalCoordinator::class, 'local_coordinator_id', 'id');
    }
}
