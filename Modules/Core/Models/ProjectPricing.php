<?php

namespace Modules\Core\Models;


use Illuminate\Database\Eloquent\Model;
use Modules\Project\Models\Project;

class ProjectPricing extends Model
{
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
