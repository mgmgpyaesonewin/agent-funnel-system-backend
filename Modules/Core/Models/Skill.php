<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
// scopes
use Modules\Core\Scopes\EnableScope;
class Skill extends Model
{
    protected $fillable = [
        'name','enable'
    ];

    public function freelancers()
    {
        return $this->belongsToMany(\Modules\Freelancer\Models\Freelancer::class, 'freelancer_skills');
    }

    public function subcategory()
    {
        return $this->belongsToMany(\Modules\Core\Models\SubCategory::class, 'job_skills');
    }

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
    
}
