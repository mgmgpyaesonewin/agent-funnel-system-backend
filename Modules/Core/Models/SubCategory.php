<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model; 
//use Modules\Core\Models\Category;
// scopes
use Modules\Core\Scopes\EnableScope;


class SubCategory extends Model
{
    protected $fillable = [
        'category_id','name','enable'
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
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    public function jobSkills()
    {
      return $this->belongsToMany(Skill::class,'job_skills');
    }

    /**
     * ----------------------------------------------------------------------------
     * GLOBAL AND LOCAL SCOPES
     * ----------------------------------------------------------------------------
     */

    
    public function scopeEnable($query){ 
      return $query->where('enable', true);
  }
}
