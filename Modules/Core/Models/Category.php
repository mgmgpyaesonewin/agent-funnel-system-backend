<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
// scopes
use Modules\Core\Scopes\EnableScope;
class Category extends Model
{
    protected $fillable = [
        'name','enable'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EnableScope);
    }

    public function subCategory(){
        return $this->hasMany(SubCategory::class);
    }

    public function skill(){
        return $this->hasManyThrough(SubCategory::class, Skill::class);
    }

}


