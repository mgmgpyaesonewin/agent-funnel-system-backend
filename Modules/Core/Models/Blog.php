<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Kyawnaingtun\Tounicode\TounicodeTrait;
class Blog extends Model
{
    use TounicodeTrait;

    protected $table = 'blogs';
    protected $convertable = ['title', 'content'];

    /**
     * ----------------------------------------------------------------------------
     * RELATIONSHIP FUNCTIONS
     * ----------------------------------------------------------------------------
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function blog_tag()
    {
        return $this->belongsToMany(Tag::class,'blog_tags');
    }

    public function photo()
    {
        return $this->belongsTo(Upload::class, 'preview_photo', 'id');
    }
    /**
     * ----------------------------------------------------------------------------
     * GETTER ATTRIBUTES
     * ----------------------------------------------------------------------------
     */
}
