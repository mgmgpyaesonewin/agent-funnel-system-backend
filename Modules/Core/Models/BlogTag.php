<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    public function tag()
    {
    	return $this->belongsTo(Tag::class);
    }

    public function blog()
    {
    	return $this->belongsTo(Blog::class);
    }
}
