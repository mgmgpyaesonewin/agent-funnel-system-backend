<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public function photo()
    {
        return $this->belongsTo(Upload::class, 'pro_pic', 'id');
    }
}
