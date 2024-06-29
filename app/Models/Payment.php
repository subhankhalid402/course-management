<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'course_id',
        'amount',
        'status',
        'payment_method',
        'paid_by',
        'attachments',
        'invoice_no',
        'amount',
        'paid_to',
        'paid_by',
        'item_service',
        'program_name',
        'date'
    ];

    protected $casts = [
        'attachments' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


}
