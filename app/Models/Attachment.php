<?php

namespace App\Models;

use App\Helpers\SiteHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['created_at_formatted', 'file_name_url'];

    public function getCreatedAtFormattedAttribute()
    {
        return SiteHelper::reformatReadableDateTime($this->created_at);
    }

    public function getFileNameUrlAttribute()
    {
        $file_path = '';
        if ($this->context == 'dog-image') {
            $file_path = asset('storage/order-proof-signatures');
        }

//        return asset('storage/order-proof-signatures');
        return $file_path . '/' . $this->file_name;
    }
}
