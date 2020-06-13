<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

use Modules\Core\Models\Project;

class PromoCode extends Model
{
    protected $fillable = ['id','code','from','to','remark','status', 'type', 'value', 'category_id', 'service_type_id'];

    protected $dates = ['from', 'to'];


    public function project()
    {
        return $this->hasMany(Project::class, 'code');
    }

}
