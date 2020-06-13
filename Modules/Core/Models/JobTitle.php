<?php

namespace Modules\Freelancer\Models;

use Illuminate\Database\Eloquent\Model;
// models
use Modules\Freelancer\Models\Freelancer;

class JobTitle extends Model
{
    protected $fillable = [
        'freelancer_id',
        'sub_category_id'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function subcategory()
    {
        return $this->hasOne('Modules\Core\Models\SubCategory','id','sub_category_id');
    }
}
