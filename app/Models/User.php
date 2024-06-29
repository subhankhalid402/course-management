<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    use HasApiTokens;

    protected $guarded = [];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['created_at_formatted'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function dog()
    {
        return $this->hasOne(Dog::class);
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'object_id', 'id')->where('object', 'User');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function getCreatedAtFormattedAttribute()
    {
        if (empty($this->created_at)) {
            return '';
        } else {
            return Carbon::parse($this->created_at)->format('d/m/Y');
        }
    }
}
